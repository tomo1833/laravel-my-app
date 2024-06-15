<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ImageController extends Controller
{
    public function index()
    {
        Log::debug("--ImageController start --- ");        
        $files = File::files(public_path('images'));
        $images = [];
        foreach ($files as $file) {
            $images[] = $file->getFilename();
        }
        return Inertia::render('Images/Index', ['images' => $images]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        return redirect()->back();
    }
}
