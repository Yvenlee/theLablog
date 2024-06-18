@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Blogs</h1>
    <a href="{{ route('blogs.create') }}" class="btn btn-primary mb-3">Create New Blog</a>
    @foreach($blogs as $blog)
        <div class="card mb-3">
            <div class="card-body">
                <h2 class="card-title">{{ $blog->title }}</h2>
                <p class="card-text">{{ Str::limit($blog->content, 150) }}</p>
                <a href="{{ route('blogs.show', $blog) }}" class="btn btn-secondary">View</a>
                <a href="{{ route('blogs.edit', $blog) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('blogs.destroy', $blog) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
