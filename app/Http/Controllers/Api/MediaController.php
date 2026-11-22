<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\MediaResource;
use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;
use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    // Menampilkan semua media dan pencarian berdasarkan judul
public function index(Request $request)
{
    $query = Media::query();

    if ($request->has('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    return MediaResource::collection($query->get());
}
    // Menampilkan detail media berdasarkan ID
public function show($id)
{
    $media = Media::findOrFail($id);

    return new MediaResource($media);
}
    // Menambahkan media baru
public function store(StoreMediaRequest $request)
{
    $media = Media::create($request->validated());

    return response()->json([
        'message' => 'Media berhasil ditambahkan',
        'data' => new MediaResource($media)
    ], 201);
}

    // Mengubah media berdasarkan ID
public function update(UpdateMediaRequest $request, $id)
{
    $media = Media::findOrFail($id);

    $media->update($request->validated());

    return response()->json([
        'message' => 'Media berhasil diperbarui',
        'data' => new MediaResource($media)
    ]);
}

    // Menghapus media berdasarkan ID
    public function destroy($id)
    {
        $media = Media::findOrFail($id);

        $media->delete();

        return response()->json([
            'message' => 'Media berhasil dihapus'
        ]);
    }
}