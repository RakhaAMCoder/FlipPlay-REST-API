<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Media;

class CollectionController extends Controller
{
    // Menambahkan media ke koleksi user
    public function store($userId, $mediaId)
    {
        $user = User::findOrFail($userId);
        $media = Media::findOrFail($mediaId);

        $user->media()->syncWithoutDetaching([$media->id]);

        return response()->json([
            'message' => 'Media berhasil ditambahkan ke koleksi',
            'data' => $media
        ]);
    }

    // Menampilkan koleksi media user
    public function index($userId)
    {
        $user = User::findOrFail($userId);

        return response()->json([
            'data' => $user->media
        ]);
    }

    // Menghapus media dari koleksi user
    public function destroy($userId, $mediaId)
    {
        $user = User::findOrFail($userId);
        $media = Media::findOrFail($mediaId);

        $user->media()->detach($media->id);

        return response()->json([
            'message' => 'Media berhasil dihapus dari koleksi'
        ]);
    }
}