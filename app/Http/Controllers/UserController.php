<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function allUsers() {
        $searchPar = request()->query('search') ? request()->query('search') : null;

        $query = User::select('id', 'name', 'email', 'photo');

        if ($searchPar) {
            $query->where('name', 'LIKE', "%{$searchPar}%")
                ->orWhere('email', 'LIKE', "%{$searchPar}%");
        }

        $users = $query->get();

        return view('users.allusers', compact('users'));
    }



    public function addUsers() {
        return view('users.addusers');
    }



    public function storeUser(Request $request) {

        // dd($request->all());

        //validar os dados no servidor
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'photo' => 'nullable|image'
        ]);

        //guardar a foto, se existir
        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('users', 'public');
        }

        //depois de validados, inserir na bd
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo' => $photoPath,
            'user_type' => $request->email == 'admin@gmail.com'
                    ? User::TYPE_ADMIN
                    : User::TYPE_GENERIC_USER
        ]);

        return redirect()->route('login')->with('status', 'Conta criada com sucesso! Já podes entrar.');

    }



    public function editUsers($id)
    {
        //editar o próprio perfil
        if (Auth::id() != $id) {
            abort(403);
        }

        $user = User::findOrFail($id);

        return view('users.editusers', compact('user'));
    }



    public function updateUser(Request $request, $id)
    {
        if (Auth::id() != $id) {
            abort(403);
        }

        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|max:50',
            'photo' => 'nullable|image|max:2048',
        ]);

        $user->name = $request->name;

        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            $user->photo = $request->file('photo')->store('users', 'public');
        }

        $user->save();

        return redirect()->route('dashboard.home')->with('message', 'Perfil atualizado com sucesso!');
    }



}
