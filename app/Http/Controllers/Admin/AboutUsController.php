<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUs;

class AboutUsController extends Controller
{
    public function edit()
    {
        $about = AboutUs::first();
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $about = AboutUs::first() ?? new AboutUs();
        $about->title = $request->title;
        $about->description = $request->description;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/about'), $filename);
            $about->image = 'uploads/about/' . $filename;
        }

        $about->save();

        return redirect()->back()->with('success', 'About Us content updated successfully!');
    }
}
