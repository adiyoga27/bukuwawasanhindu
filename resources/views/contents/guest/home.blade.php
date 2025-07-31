@extends('layouts/guest')
@section('css')
    <title>Home - Buku Wawasan Hindu</title>
     
   
@endsection
@section('content')
    
    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content">
                <h1 class="display-4 fw-bold mb-4">Jelajahi Wawasan Hindu</h1>
                <p class="lead mb-4">Temukan kebijaksanaan kuno dalam koleksi buku dan artikel kami yang lengkap tentang agama Hindu, filosofi, dan budaya.</p>
                <a href="#" class="btn btn-accent">Jelajahi Sekarang</a>
            </div>
        </div>
    </section>

    <!-- Popular Books Section -->
    <section class="container">
        <h2 class="section-title">Buku Terbaru</h2>
        
        <div id="booksCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @php $chunks = $books->take(10)->chunk(4); @endphp
                @foreach($chunks as $chunk)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <div class="row g-4">
                        @foreach($chunk as $b)
                        <div class="col-md-3">
                            <div class="card h-100">
                                <div class="book-img">
                                    <img src="{{ url('storage') }}/{{ $b->thumbnail }}" class="card-img-top" alt="{{ $b->title }}">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $b->title }}</h5>
                                    <p class="card-text text-muted small">oleh {{ $b->author }}</p>
                                    
                                    <div class="d-flex align-items-center mb-2">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $b->rating)
                                                <i class="fas fa-star text-warning me-1"></i>
                                            @elseif ($i - 0.5 <= $b->rating)
                                                <i class="fas fa-star-half-alt text-warning me-1"></i>
                                            @else
                                                <i class="far fa-star text-warning me-1"></i>
                                            @endif
                                        @endfor
                                        <span class="ms-1 small">{{ number_format($b->rating, 1) }}</span>
                                    </div>
                                    
                                    @if ($b->discount > 0)
                                        <p class="h5 text-primary mb-3">
                                            Rp {{ number_format($b->discount, 0, ',', '.') }}
                                            <span class="text-decoration-line-through text-muted small ms-2">
                                                Rp {{ number_format($b->price, 0, ',', '.') }}
                                            </span>
                                        </p>
                                    @else
                                        <p class="h5 text-primary mb-3">
                                            Rp {{ number_format($b->price, 0, ',', '.') }}
                                        </p>
                                    @endif
                                    
                                    <button class="btn btn-primary w-100" id="add-to-whatsapp" 
                                        data-book-id="{{ $b->id }}"
                                        data-book-title="{{ $b->title }}"
                                        data-price="{{ $b->discount > 0 ? $b->discount : $b->price }}">
                                        Beli Sekarang
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#booksCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#booksCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            <div class="carousel-indicators position-static mt-4">
                @foreach($chunks as $chunk)
                <button type="button" data-bs-target="#booksCarousel" data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></button>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Popular Articles Section -->
    <section class="bg-light py-5 my-5">
        <div class="container">
            <h2 class="section-title">Artikel Terbaru</h2>
            
            <div id="articlesCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @php $articleChunks = $articles->take(10)->chunk(3); @endphp
                    @foreach($articleChunks as $chunk)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <div class="row g-4">
                            @foreach($chunk as $art)
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="article-img position-relative">
                                        <img src="{{ url('storage') }}/{{ $art->featured_image }}" class="card-img-top" alt="{{ $art->title }}">
                                        <span class="article-category">Philosophy</span>
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <div class="d-flex align-items-center text-muted small mb-2">
                                            <i class="far fa-calendar-alt me-2"></i>
                                            {{ $art->created_at->format('M d, Y') }}
                                        </div>
                                        <h5 class="card-title">{{ $art->title }}</h5>
                                        <p class="card-text text-muted">{{ Str::limit(strip_tags($art->content), 100) }}</p>
                                        <a href="{{ url('articles/'.$art->slug) }}" class="btn btn-link text-primary mt-auto ps-0 text-decoration-none">
                                            Baca Selengkapnya <i class="fas fa-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#articlesCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#articlesCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                <div class="carousel-indicators position-static mt-4">
                    @foreach($articleChunks as $chunk)
                    <button type="button" data-bs-target="#articlesCarousel" data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></button>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="container">
        <div class="newsletter-section position-relative overflow-hidden">
            <div class="position-relative z-index-1">
                <h2 class="mb-4">Berlangganan Newsletter</h2>
                <p class="mb-5 mx-auto" style="max-width: 600px;">Dapatkan update terbaru tentang buku-buku Hindu, artikel, dan promo menarik langsung ke email Anda.</p>
                
                <form class="newsletter-form d-flex justify-content-center">
                    <div class="input-group" style="max-width: 500px;">
                        <input type="email" class="form-control" placeholder="Masukkan alamat email Anda">
                        <button class="btn btn-accent" type="submit">Berlangganan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
