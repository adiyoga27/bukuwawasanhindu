@extends('layouts.guest')
@section('css')
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #34495e;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .top-bar {
            background-color: var(--primary-color);
            color: white;
            padding: 10px 0;
            font-size: 14px;
        }
        
        .navbar-custom {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar-custom .nav-link {
            color: var(--primary-color);
            font-weight: 500;
            padding: 10px 15px;
        }
        
        .navbar-custom .nav-link:hover {
            color: var(--accent-color);
        }
        
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        
        .search-box {
            max-width: 600px;
            margin: 0 auto;
        }
        
        .book-card {
            transition: all 0.3s;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .book-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }
        
        .discount-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: var(--accent-color);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
        }
        
        .category-box {
            background-color: var(--light-color);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        
        .category-list {
            list-style: none;
            padding: 0;
        }
        
        .category-list li {
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
        }
        
        .category-list li:last-child {
            border-bottom: none;
        }
        
        .category-list li a {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .category-list li a:hover {
            color: var(--accent-color);
        }
    </style>
@endsection
@section('content')
    
            <!-- Sidebar -->
            <div class="col-lg-3">
                <div class="category-box">
                    <h4 class="mb-4">Menu</h4>
                    <ul class="category-list">
                        <li><a href="{{ url('/') }}">Semua Kategori</a></li>
                        @foreach($categories as $category)
                            <li><a href="{{ url('categories/'.$category->slug) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Get in Touch</h5>
                        <p class="card-text">Have questions about our books? Contact us anytime!</p>
                        <button class="btn btn-primary"><i class="fas fa-envelope me-2"></i> Email Us</button>
                    </div>
                </div>
            </div>
            
            <!-- Book List -->
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-12 mb-4">
                        <form method="GET" action="{{ url('categories/'.$category->slug) }}">
                            <div class="input-group">
                                <select class="form-select" name="sort" onchange="this.form.submit()">
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                    <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Rating</option>
                                </select>
                                <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-filter"></i> Sort</button>
                            </div>
                        </form>
                    </div>
                    @if($books->isEmpty())
                        <div class="col-12">
                            <div class="alert alert-info text-center">
                                <strong>No books available in this category.</strong>
                            </div>
                        </div>
                    @endif
                    @foreach($books as $book)
                        <div class="col-md-4">
                            <div class="card book-card">
                                @if($book->discount > 0)
                                    <span class="discount-badge">-{{ ($book->price - $book->discount)/$book->price * 100 }}%%</span>
                                @endif
                                <img src="{{ url('storage') }}/{{ $book->thumbnail }}" class="card-img-top" alt="{{ $book->title }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $book->title }}</h5>
                                    <p class="card-text text-muted">{{ $book->author }} | {{ $book->category->name }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            @if($book['discount'] > 0)
                                                <span class="text-danger fw-bold">Rp {{ number_format(($book->discount > 0 ? $book->discount : $book->price), 0, ',', '.') }}</span>
                                                <small class="text-decoration-line-through text-muted ms-2">Rp {{ number_format($book->price, 0, ',', '.') }}</small>
                                            @else
                                                <span class="fw-bold">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                                            @endif
                                        </div>
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-star"></i> {{ $book->rating }}
                                        </span>
                                    </div>
                                    <a href="{{ url('product/')}}/{{  $book->slug }}" class="btn btn-primary mt-3 w-100">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
@endsection
       