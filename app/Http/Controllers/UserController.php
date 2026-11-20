<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function allUsers() {
        $searchPar = request()->query('search') ? request()->query('search') : null;

        $query = User::select('id', 'name', 'email');

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
            'password' => 'required|min:8'
        ]);

        //depois de validados, inserir na bd
        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('users.all')->with('message', 'utilizador adicionado com sucesso!');

    }



}
