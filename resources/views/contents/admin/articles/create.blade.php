@extends('layouts.app')

@section('title', isset($article) ? 'Edit Article' : 'Create Article')

@section('content')
    <div class="container">
        <h1>{{ isset($article) ? 'Edit Article' : 'Create Article' }}</h1>
        
        <form action="{{ isset($article) ? route('articles.update', $article->slug) : route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($article))
                @method('PUT')
            @endif
            
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $article->title ?? '') }}" required>
            </div>
            
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="10" required>{{ old('content', $article->content ?? '') }}</textarea>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-select" id="category_id" name="category_id">
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $article->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="tags" class="form-label">Tags</label>
                    <select class="form-select" id="tags" name="tags[]" multiple>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}" {{ isset($article) && $article->tags->contains($tag->id) ? 'selected' : '' }}>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="excerpt" class="form-label">Excerpt (Optional)</label>
                <textarea class="form-control" id="excerpt" name="excerpt" rows="3">{{ old('excerpt', $article->excerpt ?? '') }}</textarea>
                <small class="text-muted">A short summary of your article</small>
            </div>
            
            <div class="mb-3">
                <label for="featured_image" class="form-label">Featured Image</label>
                <input type="file" class="form-control" id="featured_image" name="featured_image">
                @if(isset($article) && $article->featured_image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $article->featured_image) }}" alt="Current featured image" style="max-height: 200px;">
                    </div>
                @endif
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="meta_title" class="form-label">Meta Title (Optional)</label>
                    <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title', $article->meta_title ?? '') }}">
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="meta_description" class="form-label">Meta Description (Optional)</label>
                    <textarea class="form-control" id="meta_description" name="meta_description" rows="2">{{ old('meta_description', $article->meta_description ?? '') }}</textarea>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="meta_keywords" class="form-label">Meta Keywords (Optional)</label>
                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $article->meta_keywords ?? '') }}">
                    <small class="text-muted">Separate with commas</small>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1" {{ old('is_published', isset($article) ? $article->is_published : false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_published">
                            Publish Article
                        </label>
                    </div>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="published_at" class="form-label">Publish Date</label>
                    <input type="datetime-local" class="form-control" id="published_at" name="published_at" value="{{ old('published_at', isset($article) ? $article->published_at->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}">
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">{{ isset($article) ? 'Update Article' : 'Create Article' }}</button>
            <a href="{{ route('articles.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    
    @push('scripts')
        <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('content', {
                toolbar: [
                    { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat'] },
                    { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Blockquote'] },
                    { name: 'links', items: ['Link', 'Unlink'] },
                    { name: 'insert', items: ['Image', 'Table'] },
                    { name: 'tools', items: ['Maximize'] },
                    { name: 'document', items: ['Source'] }
                ]
            });
        </script>
    @endpush
@endsection