@extends('layouts.app')

@section('title', $article->meta_title ?: $article->title)
@section('meta')
    <meta name="description" content="{{ $article->meta_description }}">
    <meta name="keywords" content="{{ $article->meta_keywords }}">
    <meta property="og:title" content="{{ $article->title }}">
    <meta property="og:description" content="{{ $article->meta_description }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    @if($article->featured_image)
        <meta property="og:image" content="{{ asset('storage/' . $article->featured_image) }}">
    @endif
@endsection

@section('content')
    <article>
        <header class="mb-4">
            <h1 class="fw-bolder mb-1">{{ $article->title }}</h1>
            <div class="text-muted fst-italic mb-2">
                Posted on {{ $article->published_at->format('F j, Y') }} by {{ $article->user->name }}
            </div>
            <div class="mb-3">
                @if($article->category)
                    <a class="badge bg-primary text-decoration-none" href="{{ route('articles.category', $article->category->slug) }}">
                        {{ $article->category->name }}
                    </a>
                @endif
                @foreach($article->tags as $tag)
                    <a class="badge bg-secondary text-decoration-none" href="{{ route('articles.tag', $tag->slug) }}">
                        {{ $tag->name }}
                    </a>
                @endforeach
            </div>
            @if($article->featured_image)
                <img class="img-fluid rounded" src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" />
            @endif
        </header>
        
        <section class="mb-5">
            {!! $article->content !!}
        </section>

        <section class="mb-5">
            <div class="card bg-light">
                <div class="card-body">
                    <h5 class="card-title">Article Stats</h5>
                    <p class="card-text">
                        <strong>Views:</strong> {{ $article->views->count() }}<br>
                        <strong>Last viewed:</strong> {{ $article->views->last() ? $article->views->last()->created_at->diffForHumans() : 'Never' }}
                    </p>
                </div>
            </div>
        </section>
    </article>

    @auth
        <div class="d-flex justify-content-end mb-4">
            <a href="{{ route('articles.edit', $article->slug) }}" class="btn btn-primary me-2">Edit</a>
            <form action="{{ route('articles.destroy', $article->slug) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    @endauth
@endsection