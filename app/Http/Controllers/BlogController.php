<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Str;


class BlogController extends Controller
{

    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'excerpt' => 'required|string',
        'content' => 'required|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images/blogs', 'public');
    }

    Blog::create([
        'title' => $validated['title'],
        'slug' => Str::slug($validated['title']),
        'excerpt' => $validated['excerpt'],
        'content' => $validated['content'],
        'image' => $imagePath,
    ]);

    return redirect()->route('customer.blog.index')->with('success', 'Artikel berhasil ditambahkan!');
}
    public function index()
    {
        $posts = Blog::paginate(5); // misalnya
 // atau bisa pakai paginate jika pakai links()
        return view('customer.blog.index', compact('posts')); // sesuai struktur folder
    }

    public function show($slug)
    {
        $post = Blog::where('slug', $slug)->firstOrFail();
        return view('customer.blog.show', compact('post'));
    }
    
    public function landing() {
    $posts = Blog::latest()->take(3)->get(); // ambil 3 blog terbaru
    return view('landing', compact('posts'));
}

}

