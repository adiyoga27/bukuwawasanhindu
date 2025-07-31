<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookland - Wawasan Hindu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
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
            line-height: 1.6;
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

        .nav-link {
            font-weight: 500;
            position: relative;
            padding: 0.5rem 1rem;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 1rem;
            background-color: var(--accent);
            transition: var(--transition);
        }

        .nav-link:hover::after {
            width: calc(100% - 2rem);
        }

        .hero-section {
            background: url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center/cover;
            height: 500px;
            position: relative;
            color: white;
            margin-bottom: 4rem;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 600px;
        }

        .section-title {
            text-align: center;
            margin: 4rem 0 3rem;
            font-size: 2.2rem;
            color: var(--dark);
            position: relative;
            padding-bottom: 1rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--accent);
            border-radius: 2px;
        }

        .card {
            border: none;
            border-radius: var(--border-radius);
            overflow: hidden;
            transition: var(--transition);
            box-shadow: var(--card-shadow);
            margin-bottom: 20px;
            height: 100%;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .book-img, .article-img {
            height: 320px;
            overflow: hidden;
        }

        .book-img img, .article-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .card:hover .book-img img, 
        .card:hover .article-img img {
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

        .btn-accent {
            background: var(--accent);
            color: var(--secondary);
            font-weight: 600;
            border-radius: 50px;
            padding: 0.8rem 2rem;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(255, 209, 102, 0.3);
        }

        .btn-accent:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255, 209, 102, 0.4);
            background: #ffc747;
        }

        .newsletter-section {
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            color: white;
            padding: 5rem 0;
            text-align: center;
            margin: 4rem auto;
            border-radius: var(--border-radius);
            position: relative;
            overflow: hidden;
            box-shadow: var(--card-shadow);
        }

        .newsletter-section::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .newsletter-section::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .newsletter-form .form-control {
            border-radius: 50px 0 0 50px;
            padding: 1rem 1.5rem;
            border: none;
        }

        .newsletter-form .btn {
            border-radius: 0 50px 50px 0;
            padding: 0 2rem;
        }

        footer {
            background: var(--dark);
            color: white;
            padding: 5rem 0 2rem;
            margin-top: 4rem;
        }

        .footer-column h3 {
            margin-bottom: 1.8rem;
            font-size: 1.3rem;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-column h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--accent);
        }

        .footer-links {
            list-style: none;
            padding-left: 0;
        }

        .footer-links li {
            margin-bottom: 1rem;
        }

        .footer-links a {
            color: #ccc;
            text-decoration: none;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: var(--accent);
            transform: translateX(5px);
        }

        .social-links a {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            margin-right: 0.5rem;
        }

        .social-links a:hover {
            background: var(--primary);
            transform: translateY(-3px);
        }

        .copyright {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #ccc;
            font-size: 0.9rem;
        }

        /* Carousel controls */
        .carousel-control-prev, 
        .carousel-control-next {
            width: 40px;
            height: 40px;
            background-color: var(--primary);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            opacity: 1;
        }

        .carousel-control-prev {
            left: -20px;
        }

        .carousel-control-next {
            right: -20px;
        }

        .carousel-indicators button {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin: 0 5px;
            background-color: rgba(79, 108, 236, 0.5);
            border: none;
        }

        .carousel-indicators button.active {
            background-color: var(--primary);
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .hero-section {
                height: 400px;
                text-align: center;
            }
            
            .hero-content {
                max-width: 100%;
            }
            
            .newsletter-form {
                flex-direction: column;
            }
            
            .newsletter-form .form-control {
                border-radius: 50px;
                margin-bottom: 1rem;
            }
            
            .newsletter-form .btn {
                border-radius: 50px;
                padding: 1rem;
            }
        }

        @media (max-width: 768px) {
            .book-img, .article-img {
                height: 250px;
            }
            
            .carousel-control-prev {
                left: 0;
            }
            
            .carousel-control-next {
                right: 0;
            }
        }

        @media (max-width: 576px) {
            .hero-section {
                height: 350px;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
            
            .book-img, .article-img {
                height: 200px;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-book-open me-2"></i>Bookland
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('book') }}">Buku Hindu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('article') }}">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('contact') }}">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

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
                                        <a href="#" class="btn btn-link text-primary mt-auto ps-0 text-decoration-none">
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

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-column">
                        <h3>Tentang Bookland</h3>
                        <p>Bookland adalah toko buku online yang berfokus pada literatur Hindu, menyediakan buku-buku berkualitas tentang filosofi, budaya, dan spiritualitas Hindu.</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="footer-column">
                        <h3>Kategori</h3>
                        <ul class="footer-links">
                            <li><a href="#">Kitab Suci Hindu</a></li>
                            <li><a href="#">Filosofi Hindu</a></li>
                            <li><a href="#">Sejarah Hindu</a></li>
                            <li><a href="#">Yoga & Meditasi</a></li>
                            <li><a href="#">Anak-anak Hindu</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="footer-column">
                        <h3>Bantuan</h3>
                        <ul class="footer-links">
                            <li><a href="#">Pesanan Saya</a></li>
                            <li><a href="#">Pengiriman</a></li>
                            <li><a href="#">Pembayaran</a></li>
                            <li><a href="#">Pengembalian</a></li>
                            <li><a href="#">FAQ</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="footer-column">
                        <h3>Hubungi Kami</h3>
                        <p><i class="fas fa-envelope me-2"></i> {{ $configs->email }}</p>
                        <p><i class="fas fa-phone me-2"></i>+ {{ $configs->phone }}</p>
                        <div class="social-links mt-3">
                            <a href="{{ $configs->facebook }}"><i class="fab fa-facebook-f"></i></a>
                            <a href="{{ $configs->instagram }}"><i class="fab fa-instagram"></i></a>
                            <a href="{{ $configs->tiktok }}"><i class="fab fa-tiktok"></i></a>
                            <a href="{{ $configs->youtube }}"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="copyright mt-5">
                <p>&copy; {{ date('Y') }} Bookland. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // WhatsApp button functionality
        document.querySelectorAll('#add-to-whatsapp').forEach(button => {
            button.addEventListener('click', function() {
                const title = this.getAttribute('data-book-title');
                const price = this.getAttribute('data-price');

                const message = `Halo, saya tertarik dengan buku "${title}" seharga Rp${parseInt(price).toLocaleString('id-ID')}. Apakah masih tersedia?`;
                const phoneNumber = "6287762225026";
                const whatsappURL = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;

                window.open(whatsappURL, '_blank');
            });
        });
    </script>
</body>

</html>