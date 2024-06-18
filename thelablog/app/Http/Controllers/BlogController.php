<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('welcome', compact('blogs'));
    }

    public function create()
    {
        $this->authorize('create', Blog::class);

        return view('blogs.create');     
    }

    public function store(Request $request)
    {
        $this->authorize('create', Blog::class);

    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ]);

    $blog = new Blog();
    $blog->title = $request->title;
    $blog->content = $request->content;
    $blog->user_id = Auth::id(); 

    $blog->save();

    return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');
    }

    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        $this->authorize('update', $blog);

    return view('blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $this->authorize('update', $blog);

    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ]);

    $blog->title = $request->title;
    $blog->content = $request->content;

    $blog->save();

    return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('welcome')->with('success', 'Blog deleted successfully.');
    }

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
}
