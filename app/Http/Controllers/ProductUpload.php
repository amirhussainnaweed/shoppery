<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductUpload extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|max:2048',
        ]);

        $path = $request->file('avatar')->store('avatar', 'public');

        return Inertia::render('Upload', [
            'avatar' => asset("storage/$path"),
        ]);

    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:docx,pdf,txt,xlsx,zip',
        ]);

        $path = $request->file('file')->store('file', 'public');

        return Inertia::render('Upload', [
            'file' => asset("storage/$path"),
        ]);
    }

    public function show()
    {
        return Inertia::render('Upload');
    }
}
