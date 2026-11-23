<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Band;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{

    public function index(Band $band)
    {
        $albums = $band->albums;

        return view('albums.index-album', compact('band', 'albums'));
    }


    public function create(Band $band)
    {
        if (auth()->user()->user_type != User::TYPE_ADMIN) {
            abort(403);
        }

        return view('albums.create-album', compact('band'));
    }


    public function store(Request $request, Band $band)
    {
        if (auth()->user()->user_type != User::TYPE_ADMIN) {
            abort(403);
        }

        $request->validate([
            'name'         => 'required|max:255',
            'release_date' => 'required|date',
            'photo'        => 'nullable|image|max:2048',
        ]);

        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('albums', 'public');
        }

        $band->albums()->create([
            'name'         => $request->name,
            'release_date' => $request->release_date,
            'photo'        => $photoPath,
        ]);

        return redirect()->route('bands.albums', $band)->with('message', 'Álbum criado com sucesso!');
    }


    public function edit(Album $album)
    {
        return view('albums.edit-album', compact('album'));
    }


    public function update(Request $request, Album $album)
    {
        $request->validate([
            'name'         => 'required|max:255',
            'release_date' => 'required|date',
            'photo'        => 'nullable|image|max:2048',
        ]);

        $album->name = $request->name;
        $album->release_date = $request->release_date;

        if ($request->hasFile('photo')) {
            if ($album->photo) {
                Storage::disk('public')->delete($album->photo);
            }

            $album->photo = $request->file('photo')->store('albums', 'public');
        }

        $album->save();

        return redirect()->route('bands.albums', $album->band_id)->with('message', 'Álbum atualizado com sucesso!');
    }


    public function destroy(Album $album)
    {
        if (auth()->user()->user_type != User::TYPE_ADMIN) {
            abort(403);
        }

        $bandId = $album->band_id;

        if ($album->photo) {
            Storage::disk('public')->delete($album->photo);
        }

        $album->delete();

        return redirect()->route('bands.albums', $bandId)->with('message', 'Álbum apagado com sucesso!');
    }

}
