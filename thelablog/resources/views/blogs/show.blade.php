@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $blog->title }}</h1>
    <p>{{ $blog->content }}</p>
    <a href="{{ route('welcome') }}" class="btn btn-secondary">Back to Blogs</a>
</div>
@endsection
