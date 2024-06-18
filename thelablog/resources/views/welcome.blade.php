@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Blogs</h1>
        @auth
            <!-- Contenu accessible uniquement aux utilisateurs connectés -->
            <a href="{{ route('blogs.create') }}" class="btn btn-success">Create New Blog</a>
        @else
            <!-- Contenu pour les utilisateurs non connectés -->
            <p>Connectez-vous pour créer ou éditer des blogs.</p>
        @endauth
    </div>
    <div class="row">
        @foreach($blogs as $blog)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title">{{ $blog->title }}</h2>
                        <p class="card-text">{{ Str::limit($blog->content, 150) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-secondary btn-sm">View</a>
                                @auth
                                    <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                @endauth
                            </div>
                            @auth
                                <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @guest
        <div class="text-center mt-4">
            <a href="{{ route('register') }}" class="btn btn-primary">S'inscrire</a>
        </div>
    @endguest
</div>
@endsection
