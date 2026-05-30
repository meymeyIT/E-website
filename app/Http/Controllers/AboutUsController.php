<?php

namespace App\Http\Controllers;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        $about = AboutUs::first(); // get latest or first entry
        return view('frontend.about', compact('about'));
    }
}
