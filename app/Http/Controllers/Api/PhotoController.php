<?php


namespace App\Http\Controllers\Api;

use App\Models\Photo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class PhotoController extends Controller
{
    // Get all photos
    public function index()
    {
        $photos = Photo::with(['gallery', 'comments'])->get();
        return response()->json($photos);
    }

    // Get a single photo by ID
    public function show($id)
    {
        $photo = Photo::with(['gallery', 'comments'])->find($id);
        if (!$photo) {
            return response()->json(['message' => 'Photo not found'], 404);
        }
        return response()->json($photo);
    }

    // Create a new photo
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'required|url',
            'gallery_id' => 'required|exists:galleries,id',
        ]);

        $photo = Photo::create($validatedData);
        return response()->json($photo, 201);
    }

    // Update an existing photo
    public function update(Request $request, $id)
    {
        $photo = Photo::find($id);
        if (!$photo) {
            return response()->json(['message' => 'Photo not found'], 404);
        }

        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'sometimes|required|url',
            'gallery_id' => 'sometimes|required|exists:galleries,id',
        ]);

        $photo->update($validatedData);
        return response()->json($photo);
    }

    // Delete a photo
    public function destroy($id)
    {
        $photo = Photo::find($id);
        if (!$photo) {
            return response()->json(['message' => 'Photo not found'], 404);
        }

        $photo->delete();
        return response()->json(['message' => 'Photo deleted successfully']);
    }
}