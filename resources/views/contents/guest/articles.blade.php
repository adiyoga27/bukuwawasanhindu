@extends('layouts/guest')
@section('css')
    <title>Artikel - Buku Wawasan Hindu</title>

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

        .articles-hero {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                        url('https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            height: 300px;
        }

        .article-card {
            border-radius: var(--border-radius);
            overflow: hidden;
            transition: var(--transition);
            box-shadow: var(--card-shadow);
            height: 100%;
            border: none;
        }

        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .article-img {
            height: 220px;
            overflow: hidden;
            position: relative;
        }

        .article-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .article-card:hover .article-img img {
            transform: scale(1.05);
        }

        .article-category {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            backdrop-filter: blur(2px);
        }

        .article-date {
            color: #888;
            font-size: 0.8rem;
        }

        .read-more {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            transition: var(--transition);
        }

        .read-more:hover {
            color: var(--secondary);
        }

        .read-more i {
            margin-left: 6px;
            transition: transform 0.3s ease;
        }

        .read-more:hover i {
            transform: translateX(4px);
        }

        .category-badge {
            background-color: var(--primary);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            text-transform: uppercase;
        }

        .search-box {
            max-width: 500px;
            margin: 0 auto 3rem;
        }

        footer {
            background: var(--dark);
            color: white;
        }

        @media (max-width: 768px) {
            .articles-hero {
                height: 200px;
            }
            
            .article-img {
                height: 180px;
            }
        }

        @media (max-width: 576px) {
            .articles-hero {
                height: 180px;
            }
        }
    </style>
@endsection
@section('content')
    
    <!-- Hero Section -->
    <section class="articles-hero d-flex align-items-center justify-content-center text-white">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3">Artikel Hindu</h1>
            <p class="lead">Temukan kebijaksanaan kuno dalam koleksi artikel kami</p>
        </div>
    </section>

    <!-- Articles Section -->
    <section class="py-5">
        <div class="container">
            <!-- Search and Filter -->
            <div class="search-box">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari artikel...">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <div class="d-flex flex-wrap justify-content-center gap-2">
                    <a href="#" class="category-badge">Semua</a>
                    <a href="#" class="category-badge bg-secondary">Filosofi</a>
                    <a href="#" class="category-badge bg-success">Sejarah</a>
                    <a href="#" class="category-badge bg-warning text-dark">Praktik</a>
                    <a href="#" class="category-badge bg-info">Budaya</a>
                </div>
            </div>

            <!-- Articles Grid -->
            <div class="row g-4">
                @foreach($articles as $article)
                <div class="col-lg-4 col-md-6">
                    <div class="article-card card">
                        <div class="article-img">
                            <img src="{{ url('storage') }}/{{ $article->featured_image }}" class="card-img-top" alt="{{ $article->title }}">
                            <span class="article-category">{{ $article->category }}</span>
                        </div>
                        <div class="card-body">
                            <div class="article-date mb-2">
                                <i class="far fa-calendar-alt me-2"></i>{{ $article->created_at->format('d M Y') }}
                            </div>
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text text-muted">{{ Str::limit(strip_tags($article->excerpt)), 100 }}</p>
                            <a href="{{ url('articles/'.$article->slug) }}" class="read-more">
                                Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <nav class="mt-5">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="mb-4">Berlangganan Newsletter</h2>
                    <p class="mb-4">Dapatkan artikel terbaru langsung ke inbox Anda</p>
                    <form class="row g-2 justify-content-center">
                        <div class="col-md-8">
                            <input type="email" class="form-control" placeholder="Alamat email Anda">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary w-100">Berlangganan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    


@endsection