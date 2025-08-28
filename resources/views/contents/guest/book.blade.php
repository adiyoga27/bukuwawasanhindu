@extends('layouts.guest')
@section('css')
    <title>Buku - Buku Wawasan Hindu</title>

    <style>
        :root {
            --primary: #4f6cec;
            --secondary: #121f5a;
            --dark: #292f36;
            --light: #f7fff7;
            --accent: #ffd166;
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --border-radius: 12px;
            --transition: all 0.3s ease;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            color: var(--dark);
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 700;
        }

        .navbar-brand i {
            color: var(--accent);
        }
.contact-hero {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                        url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            height: 300px;
        }
       

        .sidebar {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .sidebar-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--secondary);
            position: relative;
            padding-bottom: 0.5rem;
        }

        .sidebar-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--accent);
        }

        .category-list {
            list-style: none;
            padding: 0;
        }

        .category-list li {
            padding: 0.7rem 0;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .category-list li:last-child {
            border-bottom: none;
        }

        .category-list li a {
            color: var(--dark);
            text-decoration: none;
            transition: var(--transition);
            display: flex;
            align-items: center;
        }

        .category-list li a:hover {
            color: var(--primary);
            transform: translateX(5px);
        }

        .category-list li a i {
            margin-right: 0.5rem;
            color: var(--primary);
        }

        .book-card {
            border: none;
            border-radius: var(--border-radius);
            overflow: hidden;
            transition: var(--transition);
            box-shadow: var(--card-shadow);
            margin-bottom: 2rem;
            height: 100%;
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .book-img {
            height: 250px;
            overflow: hidden;
        }

        .book-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .book-card:hover .book-img img {
            transform: scale(1.05);
        }

        .discount-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: var(--accent);
            color: var(--secondary);
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .book-info {
            padding: 1.5rem;
        }

        .book-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .book-author {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .book-rating {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .book-rating .stars {
            color: #FFD700;
            margin-right: 8px;
        }

        .book-price {
            font-weight: 700;
            color: var(--primary);
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
        }

        .book-price .original-price {
            font-size: 0.9rem;
            color: #999;
            text-decoration: line-through;
            margin-left: 8px;
        }

        .sort-select {
            border-radius: 50px;
            padding: 0.5rem 1rem;
            border: 1px solid #ddd;
            outline: none;
            transition: var(--transition);
        }

        .sort-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(79, 108, 236, 0.25);
        }

        .empty-state {
            text-align: center;
            padding: 1rem;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .empty-state h4 {
            color: var(--secondary);
            margin-bottom: 1rem;
        }

        @media (max-width: 992px) {
            .book-img {
                height: 200px;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 80px 0;
            }
            
            .book-img {
                height: 250px;
            }
        }

        @media (max-width: 576px) {
            .hero-section {
                padding: 60px 0;
            }
            
            .book-img {
                height: 200px;
            }
        }
    </style>
@endsection
@section('content')
    <!-- Hero Section -->
    <section class="contact-hero d-flex align-items-center justify-content-center text-white">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3">Hubungi Kami</h1>
            <p class="lead">Kami siap membantu Anda dengan pertanyaan tentang buku dan artikel kami.</p>
        </div>
    </section>
<div class="container py-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3">
            <div class="sidebar">
                <h4 class="sidebar-title">Kategori Buku</h4>
                <ul class="category-list">
                    <li><a href="{{ url('/') }}"><i class="fas fa-book"></i> Semua Kategori</a></li>
                    @foreach($categories as $category)
                        <li><a href="{{ url('book?category='.$category->slug) }}"><i class="fas fa-{{ $category->icon ?? 'bookmark' }}"></i> {{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            
            <div class="sidebar">
                <h4 class="sidebar-title">Butuh Bantuan?</h4>
                <p class="mb-3">Tim kami siap membantu Anda menemukan buku yang tepat.</p>
                <a href="{{ url('contact') }}" class="btn btn-primary w-100">
                    <i class="fas fa-envelope me-2"></i> Hubungi Kami
                </a>
            </div>
        </div>
        
        <!-- Book List -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-end mb-4">
                <form method="GET" action="{{ url('book/') }}" class="w-100">
                    <div class="input-group">
                        <select class="form-select sort-select" name="sort" onchange="this.form.submit()">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga: Rendah ke Tinggi</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga: Tinggi ke Rendah</option>
                            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Rating Tertinggi</option>
                        </select>
                    </div>
                </form>
            </div>
            
            @if($books->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-book-open"></i>
                    <h4>Tidak ada buku dalam kategori ini</h4>
                    <p>Silakan cek kategori lainnya atau hubungi kami untuk informasi lebih lanjut.</p>
                    <a href="{{ url('/') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-arrow-left me-2"></i> Kembali ke Beranda
                    </a>
                </div>
            @else
                <div class="row">
                    @foreach($books as $book)
                        <div class="col-md-4 col-sm-6">
                                    <a href="{{ url('product/'.$book->slug) }}" style="color: inherit; text-decoration: none;">
                            
                            <div class="book-card">
                                <div class="book-img">

                                    <img src="{{ url('storage') }}/{{ $book->thumbnail }}" alt="{{ $book->title }}">
                                    @if($book->discount > 0)
                                        <span class="discount-badge">-{{ round(($book->price - $book->discount)/$book->price * 100) }}%</span>
                                    @endif
                                </div>
                                <div class="book-info">
                                    <h5 class="book-title">{{ $book->title }}</h5>
                                    <p class="book-author">{{ $book->author }}</p>
                                    
                                    <div class="book-rating">
                                        <div class="stars">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $book->rating)
                                                    <i class="fas fa-star"></i>
                                                @elseif ($i - 0.5 <= $book->rating)
                                                    <i class="fas fa-star-half-alt"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <span class="ms-2 small">{{ number_format($book->rating, 1) }}</span>
                                    </div>
                                    
                                    @if($book->discount > 0)
                                        <p class="book-price">
                                            Rp {{ number_format($book->discount, 0, ',', '.') }}
                                            <span class="original-price">
                                                Rp {{ number_format($book->price, 0, ',', '.') }}
                                            </span>
                                        </p>
                                    @else
                                        <p class="book-price">
                                            Rp {{ number_format($book->price, 0, ',', '.') }}
                                        </p>
                                    @endif
                                    
                                    <a href="{{ url('product/'.$book->slug) }}" class="btn btn-primary w-100">
                                        Lihat Detail
                                    </a>
                                </div>

                            </div>
                                    </a>

                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $books->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection