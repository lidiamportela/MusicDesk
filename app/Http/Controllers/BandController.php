<?php

namespace App\Http\Controllers;

use App\Models\Band;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BandController extends Controller
{
    public function index()
    {
        $bands = Band::withCount('albums')->get();

        return view('bands.index-band', compact('bands'));
    }


    public function create()
    {
        if (auth()->user()->user_type != User::TYPE_ADMIN) {
        abort(403);
        }

        return view('bands.create-band');
    }


    public function store(Request $request)
    {
        if (auth()->user()->user_type != User::TYPE_ADMIN) {
        abort(403);
        }

        $request->validate([
            'name'  => 'required|max:255',
            'photo' => 'nullable|image|max:2048',
        ]);

        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('bands', 'public');
        }

        Band::create([
            'name'  => $request->name,
            'photo' => $photoPath,
        ]);

        return redirect()->route('bands.index-band')->with('message', 'Banda criada com sucesso!');
    }


    public function edit(Band $band)
    {
    return view('bands.edit-band', compact('band'));
    }


    public function update(Request $request, Band $band)
    {
        $request->validate([
            'name'  => 'required|max:255',
            'photo' => 'nullable|image|max:2048',
        ]);

        $band->name = $request->name;

        if ($request->hasFile('photo')) {
            // apaga a foto antiga, se existir
            if ($band->photo) {
                Storage::disk('public')->delete($band->photo);
            }

        $band->photo = $request->file('photo')->store('bands', 'public');
        }

        $band->save();

        return redirect()->route('bands.index-band')->with('message', 'Banda atualizada com sucesso!');
    }


    public function destroy(Band $band)
    {
        if (auth()->user()->user_type != User::TYPE_ADMIN) {
        abort(403);
        }

        if ($band->photo) {
            Storage::disk('public')->delete($band->photo);
        }

        $band->delete();

        return redirect()->route('bands.index-band')->with('message', 'Banda apagada com sucesso!');
    }



}
