<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookland - Wawasan Hindu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Add Slick Slider CSS -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
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
            --card-spacing: 20px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f9f9f9;
            color: var(--dark);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 1rem 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        /* Navigation */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
        }

        .logo i {
            margin-right: 10px;
            color: var(--accent);
        }

        .nav-links {
            display: flex;
            list-style: none;
        }

        .nav-links li {
            margin-left: 2rem;
            position: relative;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 5px 0;
        }

        .nav-links a:hover {
            color: var(--accent);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--accent);
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .mobile-menu {
            display: none;
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* Hero Section */
        .hero {
            background: url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center/cover;
            height: 500px;
            display: flex;
            align-items: center;
            position: relative;
            color: white;
            margin-bottom: 4rem;
        }

        .hero::before {
            content: '';
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
            animation: fadeInUp 1s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero h1 {
            font-size: 2.8rem;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .btn {
            display: inline-block;
            background: var(--accent);
            color: var(--secondary);
            padding: 0.8rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(255, 209, 102, 0.3);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255, 209, 102, 0.4);
            background: #ffc747;
        }

        /* Featured Books */
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

        /* Slider Styles with Spacing */
        .books-slider,
        .articles-slider {
            padding: 30px 0 50px;
            margin: 0 -15px;
        }

        .books-slider .slick-slide,
        .articles-slider .slick-slide {
            padding: 0 15px;
            margin-bottom: var(--card-spacing);
        }

        .book-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            transition: 0.4s ease;
            box-shadow: var(--card-shadow);
            margin-bottom: var(--card-spacing);
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .book-img {
            height: 320px;
            overflow: hidden;
            position: relative;
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

        .book-info {
            padding: 1.8rem;
        }

        .book-title {
            font-size: 1.25rem;
            margin-bottom: 0.8rem;
            font-weight: 600;
            color: var(--dark);
            line-height: 1.4;
        }

        .book-author {
            color: #666;
            margin-bottom: 1.2rem;
            font-size: 0.95rem;
        }

        .book-rating {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .book-rating .stars {
            color: #FFD700;
            margin-right: 8px;
        }

        .book-rating .rating-value {
            font-weight: 600;
            color: var(--dark);
        }

        .book-price {
            font-weight: 700;
            color: var(--primary);
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
        }

        .book-price .original-price {
            font-size: 0.9rem;
            color: #999;
            text-decoration: line-through;
            margin-left: 8px;
        }

        .btn-small {
            padding: 0.6rem 1.5rem;
            font-size: 0.9rem;
            width: 100%;
        }

        /* Articles Section */
        .articles {
            background: #f1f1f1;
            padding: 5rem 0;
            margin-top: 4rem;
        }

        .article-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: 0.4s ease;
            margin-bottom: var(--card-spacing);
        }

        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .article-img {
            height: 220px;
            overflow: hidden;
        }

        .article-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .article-card:hover .article-img img {
            transform: scale(1.1);
        }

        .article-content {
            padding: 1.8rem;
        }

        .article-title {
            font-size: 1.3rem;
            margin-bottom: 1rem;
            font-weight: 600;
            color: var(--dark);
        }

        .article-excerpt {
            color: #666;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .read-more {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .read-more:hover {
            color: var(--secondary);
        }

        .read-more i {
            margin-left: 5px;
            transition: transform 0.3s ease;
        }

        .read-more:hover i {
            transform: translateX(3px);
        }

        /* Newsletter */
        .newsletter {
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            color: white;
            padding: 5rem 0;
            text-align: center;
            margin-top: 4rem;
            border-radius: 12px;
            position: relative;
            overflow: hidden;
            margin: 4rem auto;
            max-width: 1200px;
            box-shadow: var(--card-shadow);
        }

        .newsletter::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .newsletter::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .newsletter h2 {
            margin-bottom: 1.5rem;
            font-size: 2rem;
            position: relative;
            z-index: 1;
        }

        .newsletter p {
            max-width: 600px;
            margin: 0 auto 2.5rem;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .newsletter-form {
            display: flex;
            max-width: 500px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .newsletter-form input {
            flex: 1;
            padding: 1rem 1.5rem;
            border: none;
            border-radius: 50px 0 0 50px;
            font-size: 1rem;
            outline: none;
        }

        .newsletter-form button {
            background: var(--accent);
            color: var(--secondary);
            border: none;
            padding: 0 2rem;
            border-radius: 0 50px 50px 0;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .newsletter-form button:hover {
            background: #ffc747;
        }

        /* Footer */
        footer {
            background: var(--dark);
            color: white;
            padding: 5rem 0 2rem;
            margin-top: 4rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 3rem;
            margin-bottom: 3rem;
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
        }

        .footer-links li {
            margin-bottom: 1rem;
        }

        .footer-links a {
            color: #ccc;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            display: inline-block;
        }

        .footer-links a:hover {
            color: var(--accent);
            transform: translateX(5px);
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .social-links a {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
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

        /* Slider Navigation */
        .slick-prev:before,
        .slick-next:before {
            color: var(--primary);
            font-size: 30px;
        }

        .slick-prev {
            left: -40px;
        }

        .slick-next {
            right: -40px;
        }

        .slick-dots li button:before {
            font-size: 12px;
            color: var(--primary);
        }

        .slick-dots li.slick-active button:before {
            color: var(--primary);
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 992px) {
            .nav-links {
                display: none;
                position: absolute;
                top: 70px;
                left: 0;
                width: 100%;
                background: var(--secondary);
                flex-direction: column;
                padding: 1rem 0;
                box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            }

            .nav-links.active {
                display: flex;
            }

            .nav-links li {
                margin: 0;
                padding: 0.8rem 2rem;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .mobile-menu {
                display: block;
            }

            .hero {
                height: 400px;
                text-align: center;
            }

            .hero h1 {
                font-size: 2.2rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .newsletter-form {
                flex-direction: column;
            }

            .newsletter-form input {
                border-radius: 50px;
                margin-bottom: 1rem;
            }

            .newsletter-form button {
                border-radius: 50px;
                padding: 1rem;
            }

            .slick-prev {
                left: -20px;
            }

            .slick-next {
                right: -20px;
            }
        }

        @media (max-width: 768px) {
            .books-slider,
            .articles-slider {
                margin: 0 -10px;
            }

            .books-slider .slick-slide,
            .articles-slider .slick-slide {
                padding: 0 10px;
            }
        }

        @media (max-width: 576px) {
            .hero {
                height: 350px;
            }
            
            .hero h1 {
                font-size: 2rem;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
            
            .footer-content {
                grid-template-columns: 1fr;
            }

            .slick-prev {
                left: -15px;
            }

            .slick-next {
                right: -15px;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="container">
            <nav>
                <div class="logo">
                    <i class="fas fa-book-open"></i>
                    <span>Bookland</span>
                </div>
                <ul class="nav-links">
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ url('book') }}">Buku Hindu</a></li>
                    <li><a href="{{ url('article') }}">Artikel</a></li>
                    <li><a href="{{ url('contact') }}">Kontak</a></li>
                </ul>
                <div class="mobile-menu">
                    <i class="fas fa-bars"></i>
                </div>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Jelajahi Wawasan Hindu</h1>
                <p>Temukan kebijaksanaan kuno dalam koleksi buku dan artikel kami yang lengkap tentang agama Hindu,
                    filosofi, dan budaya.</p>
                <a href="#" class="btn">Jelajahi Sekarang</a>
            </div>
        </div>
    </section>

    <section class="container">
        <h2 class="section-title">Buku Populer</h2>
        <div class="books-slider">
            @foreach ($books as $b)
                <div class="book-card">
                    <div class="book-img">
                        <img src="{{ url('storage') }}/{{ $b->thumbnail }}" alt="{{ $b->title }}">
                    </div>

                    <div class="book-info">
                        <h3 class="book-title">{{ $b->title }}</h3>
                        <p class="book-author">oleh {{ $b->author }}</p>
                        
                        <div class="book-rating">
                            <div class="stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $b->rating)
                                        <i class="fas fa-star"></i>
                                    @elseif ($i - 0.5 <= $b->rating)
                                        <i class="fas fa-star-half-alt"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="rating-value">{{ number_format($b->rating, 1) }}</span>
                        </div>
                        
                        @if ($b->discount > 0)
                            <p class="book-price">
                                Rp {{ number_format($b->discount, 0, ',', '.') }}
                                <span class="original-price">
                                    Rp {{ number_format($b->price, 0, ',', '.') }}
                                </span>
                            </p>
                        @else
                            <p class="book-price">
                                Rp {{ number_format($b->price, 0, ',', '.') }}
                            </p>
                        @endif

                        <button class="btn btn-small" id="add-to-whatsapp" data-book-id="{{ $b->id }}"
                            data-book-title="{{ $b->title }}"
                            data-price="{{ $b->discount > 0 ? $b->discount : $b->price }}">Beli Sekarang</button>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="articles">
        <div class="container">
            <h2 class="section-title">Artikel Terbaru</h2>
            <div class="articles-slider">
                <div class="article-card">
                    <div class="article-img">
                        <img src="https://images.unsplash.com/photo-1605000797499-95a51c5269ae?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                            alt="Makna Om">
                    </div>
                    <div class="article-content">
                        <h3 class="article-title">Makna Spiritual dari Om dalam Hindu</h3>
                        <p class="article-excerpt">Temukan makna mendalam di balik suku kata suci Om dan bagaimana
                            menggunakannya dalam meditasi sehari-hari...</p>
                        <a href="#" class="read-more">Baca Selengkapnya <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="article-card">
                    <div class="article-img">
                        <img src="https://images.unsplash.com/photo-1589994965851-a8f479c573cb?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                            alt="Karma">
                    </div>
                    <div class="article-content">
                        <h3 class="article-title">Memahami Hukum Karma dalam Hindu</h3>
                        <p class="article-excerpt">Bagaimana hukum sebab-akibat membentuk kehidupan kita menurut
                            filosofi Hindu...</p>
                        <a href="#" class="read-more">Baca Selengkapnya <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="article-card">
                    <div class="article-img">
                        <img src="https://images.unsplash.com/photo-1542272201-b1ca555f8505?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                            alt="Diwali">
                    </div>
                    <div class="article-content">
                        <h3 class="article-title">Makna Filosofis di Balik Festival Diwali</h3>
                        <p class="article-excerpt">Temukan simbolisme spiritual dalam festival cahaya yang terkenal
                            ini...</p>
                        <a href="#" class="read-more">Baca Selengkapnya <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="article-card">
                    <div class="article-img">
                        <img src="https://images.unsplash.com/photo-1589998059171-988d887df646?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                            alt="Meditasi">
                    </div>
                    <div class="article-content">
                        <h3 class="article-title">Teknik Meditasi dalam Tradisi Hindu</h3>
                        <p class="article-excerpt">Pelajari berbagai metode meditasi yang berasal dari tradisi Hindu
                            kuno...</p>
                        <a href="#" class="read-more">Baca Selengkapnya <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="article-card">
                    <div class="article-img">
                        <img src="https://images.unsplash.com/photo-1542272201-b1ca555f8505?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                            alt="Dewa">
                    </div>
                    <div class="article-content">
                        <h3 class="article-title">Memahami Trinitas Hindu: Brahma, Wisnu, Siwa</h3>
                        <p class="article-excerpt">Eksplorasi mendalam tentang tiga dewa utama dalam kosmologi Hindu...
                        </p>
                        <a href="#" class="read-more">Baca Selengkapnya <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container">
        <div class="newsletter">
            <h2>Berlangganan Newsletter</h2>
            <p>Dapatkan update terbaru tentang buku-buku Hindu, artikel, dan promo menarik langsung ke email Anda.</p>
            <form class="newsletter-form">
                <input type="email" placeholder="Masukkan alamat email Anda">
                <button type="submit">Berlangganan</button>
            </form>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>Tentang Bookland</h3>
                    <p>Bookland adalah toko buku online yang berfokus pada literatur Hindu, menyediakan buku-buku
                        berkualitas tentang filosofi, budaya, dan spiritualitas Hindu.</p>
                </div>

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

                <div class="footer-column">
                    <h3>Hubungi Kami</h3>
                    <p>Email: info@bookland.com</p>
                    <p>Telepon: (021) 1234-5678</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>

            <div class="copyright">
                <p>&copy; 2023 Bookland. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Add jQuery and Slick Slider JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

    <script>
          // Mobile menu toggle
        document.querySelector('.mobile-menu').addEventListener('click', function() {
            document.querySelector('.nav-links').classList.toggle('active');
        });

        // Initialize book slider
        $(document).ready(function() {
            $('.books-slider').slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 4,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });

            $('.articles-slider').slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 3,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });

        // WhatsApp button functionality
        document.querySelectorAll('#add-to-whatsapp').forEach(button => {
            button.addEventListener('click', function() {
                const title = this.getAttribute('data-book-title');
                const price = this.getAttribute('data-price');

                const message =
                    `Halo, saya tertarik dengan buku "${title}" seharga Rp${parseInt(price).toLocaleString('id-ID')}. Apakah masih tersedia?`;

                // Ganti nomor berikut dengan nomor admin Anda (tanpa 0 di awal, pakai 62)
                const phoneNumber = "6287762225026";

                const whatsappURL = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;

                // Buka WhatsApp
                window.open(whatsappURL, '_blank');
            });
        });
    </script>
</body>

</html>