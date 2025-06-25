<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class LandingBlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->take(6)->get(); // ambil 6 terbaru
        return view('landing.blog', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        return view('landing.blog_detail', compact('blog'));
    }
}
