<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TinyMceUploadController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'file' => ['required', 'image', 'max:5120'],
        ]);

        $file = $request->file('file');
        $path = $file->storePublicly('editor-uploads', 'public');

        return response()->json([
            'location' => asset('storage/'.$path),
        ]);
    }
}
