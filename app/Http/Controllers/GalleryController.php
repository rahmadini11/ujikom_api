<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::with('photos')->get();
        return view('admin.galleries.index', compact('galleries'));
    }

    public function userIndex()
    {
        $galleries = Gallery::all();
        return view('gallery.index', compact('galleries'));
    }

    public function show($id)
    {
        $gallery = Gallery::with('photos')->findOrFail($id);
        return view('admin.galleries.show', compact('gallery'));
    }

    public function userShow(Gallery $gallery)
    {
        return view('gallery.show', compact('gallery'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }


    public function store(Request $request)
    {
        // Validasi dan simpan galeri baru
        $validatedData = $request->validate([
            'title' => 'required|max:255',
        ]);

        $validatedData['user_id'] = Auth::id();

        Gallery::create($validatedData);

        return redirect()->route('dashboard.galleries.index')->with('success', 'Galeri berhasil dibuat.');
    }
    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery')); // Admin edit galeri
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
        ]);

        $validatedData['user_id'] = Auth::id();

        $gallery->update($validatedData);

        return redirect()->route('dashboard.galleries.index')->with('success', 'Gallery updated successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('dashboard.galleries.index')->with('success', 'Gallery deleted successfully.');
    }
}
