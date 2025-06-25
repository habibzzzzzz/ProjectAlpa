@extends('auth.dashboard')

@section('content')
<div class="container py-5">
    <h2>{{ $post->title }}</h2>
<hr>
{!! $post->content !!}

    <a href="{{ route('blog.index') }}" class="btn btn-secondary mt-4">← Kembali ke Blog</a>
</div>
@endsection
