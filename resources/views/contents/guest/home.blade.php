<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookland - Wawasan Hindu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Add Slick Slider CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
    <style>
        :root {
            --primary: #4f6cec;
            --secondary: #121f5a;
            --dark: #292f36;
            --light: #f7fff7;
            --accent: #ffd166;
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
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
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
        }
        
        .nav-links {
            display: flex;
            list-style: none;
        }
        
        .nav-links li {
            margin-left: 2rem;
        }
        
        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .nav-links a:hover {
            color: var(--accent);
        }
        
        .mobile-menu {
            display: none;
            font-size: 1.5rem;
            cursor: pointer;
        }
        
        /* Hero Section */
        .hero {
            background: url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center/cover;
            height: 400px;
            display: flex;
            align-items: center;
            position: relative;
            color: white;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 600px;
        }
        
        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        .hero p {
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }
        
        .btn {
            display: inline-block;
            background: var(--primary);
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        /* Featured Books */
        .section-title {
            text-align: center;
            margin: 3rem 0;
            font-size: 2rem;
            color: var(--dark);
        }
        
        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
        }
        
        .book-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            margin: 0 10px;
        }
        
        .book-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }
        
        .book-img {
            height: 300px;
            overflow: hidden;
        }
        
        .book-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .book-card:hover .book-img img {
            transform: scale(1.1);
        }
        
        .book-info {
            padding: 1.5rem;
        }
        
        .book-title {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }
        
        .book-author {
            color: #666;
            margin-bottom: 1rem;
        }
        
        .book-price {
            font-weight: 700;
            color: var(--primary);
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }
        
        /* Articles Section */
        .articles {
            background: #f1f1f1;
            padding: 4rem 0;
        }
        
        .articles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .article-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin: 0 10px;
        }
        
        .article-content {
            padding: 1.5rem;
        }
        
        .article-title {
            font-size: 1.3rem;
            margin-bottom: 1rem;
        }
        
        .article-excerpt {
            color: #666;
            margin-bottom: 1.5rem;
        }
        
        .read-more {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }
        
        /* Newsletter */
        .newsletter {
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            color: white;
            padding: 4rem 0;
            text-align: center;
        }
        
        .newsletter h2 {
            margin-bottom: 1rem;
        }
        
        .newsletter p {
            max-width: 600px;
            margin: 0 auto 2rem;
        }
        
        .newsletter-form {
            display: flex;
            max-width: 500px;
            margin: 0 auto;
        }
        
        .newsletter-form input {
            flex: 1;
            padding: 1rem;
            border: none;
            border-radius: 50px 0 0 50px;
            font-size: 1rem;
        }
        
        .newsletter-form button {
            background: var(--dark);
            color: white;
            border: none;
            padding: 0 2rem;
            border-radius: 0 50px 50px 0;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .newsletter-form button:hover {
            background: #1a1f24;
        }
        
        /* Footer */
        footer {
            background: var(--dark);
            color: white;
            padding: 4rem 0 2rem;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .footer-column h3 {
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
        }
        
        .footer-links {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 0.8rem;
        }
        
        .footer-links a {
            color: #ccc;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .footer-links a:hover {
            color: white;
            padding-left: 5px;
        }
        
        .social-links {
            display: flex;
            gap: 1rem;
        }
        
        .social-links a {
            color: white;
            background: rgba(255,255,255,0.1);
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
            border-top: 1px solid rgba(255,255,255,0.1);
            color: #ccc;
        }
        
        /* Slider Styles */
        .books-slider, .articles-slider {
            padding: 20px 0;
        }
        
        .slick-prev:before, 
        .slick-next:before {
            color: var(--primary);
            font-size: 25px;
        }
        
        .slick-prev {
            left: -30px;
        }
        
        .slick-next {
            right: -30px;
        }
        
        .slick-dots li button:before {
            font-size: 12px;
            color: var(--primary);
        }
        
        .slick-dots li.slick-active button:before {
            color: var(--primary);
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .mobile-menu {
                display: block;
            }
            
            .hero {
                height: 300px;
            }
            
            .hero h1 {
                font-size: 2rem;
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
                <p>Temukan kebijaksanaan kuno dalam koleksi buku dan artikel kami yang lengkap tentang agama Hindu, filosofi, dan budaya.</p>
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
                    <img src="{{ url('storage') }}/{{ $b->thumbnail }}" alt="Bhagavad Gita">
                </div>
      
                <div class="book-info">
                    <h3 class="book-title">{{ $b->title }}</h3>
                    <p class="book-author">oleh {{ $b->author }}</p>
                    <p class="book-price">Rp {{ number_format($b->price, 0, ',','.') }}</p>
                    <button href="#" class="btn" id="add-to-whatsapp"  data-book-id="{{ $b->id }}"
                                data-book-title="{{ $b->title }}"
                                data-price="{{ $b->discount > 0 ? $b->discount : $b->price }}">Beli Sekarang</button>
                </div>
            </div>
            @endforeach
            
        </div>
    </section>

    <section class="articles">
        <div class="container">
            <h2 class="section-title">Artikel</h2>
            <div class="articles-slider">
                <div class="article-card">
                    <div class="article-img">
                        <img src="https://images.unsplash.com/photo-1605000797499-95a51c5269ae?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Makna Om" style="width:100%; height:200px; object-fit:cover;">
                    </div>
                    <div class="article-content">
                        <h3 class="article-title">Makna Spiritual dari Om dalam Hindu</h3>
                        <p class="article-excerpt">Temukan makna mendalam di balik suku kata suci Om dan bagaimana menggunakannya dalam meditasi sehari-hari...</p>
                        <a href="#" class="read-more">Baca Selengkapnya →</a>
                    </div>
                </div>
                
                <div class="article-card">
                    <div class="article-img">
                        <img src="https://images.unsplash.com/photo-1589994965851-a8f479c573cb?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Karma" style="width:100%; height:200px; object-fit:cover;">
                    </div>
                    <div class="article-content">
                        <h3 class="article-title">Memahami Hukum Karma dalam Hindu</h3>
                        <p class="article-excerpt">Bagaimana hukum sebab-akibat membentuk kehidupan kita menurut filosofi Hindu...</p>
                        <a href="#" class="read-more">Baca Selengkapnya →</a>
                    </div>
                </div>
                
                <div class="article-card">
                    <div class="article-img">
                        <img src="https://images.unsplash.com/photo-1542272201-b1ca555f8505?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Diwali" style="width:100%; height:200px; object-fit:cover;">
                    </div>
                    <div class="article-content">
                        <h3 class="article-title">Makna Filosofis di Balik Festival Diwali</h3>
                        <p class="article-excerpt">Temukan simbolisme spiritual dalam festival cahaya yang terkenal ini...</p>
                        <a href="#" class="read-more">Baca Selengkapnya →</a>
                    </div>
                </div>
                
                <div class="article-card">
                    <div class="article-img">
                        <img src="https://images.unsplash.com/photo-1589998059171-988d887df646?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Meditasi" style="width:100%; height:200px; object-fit:cover;">
                    </div>
                    <div class="article-content">
                        <h3 class="article-title">Teknik Meditasi dalam Tradisi Hindu</h3>
                        <p class="article-excerpt">Pelajari berbagai metode meditasi yang berasal dari tradisi Hindu kuno...</p>
                        <a href="#" class="read-more">Baca Selengkapnya →</a>
                    </div>
                </div>
                
                <div class="article-card">
                    <div class="article-img">
                        <img src="https://images.unsplash.com/photo-1542272201-b1ca555f8505?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Dewa" style="width:100%; height:200px; object-fit:cover;">
                    </div>
                    <div class="article-content">
                        <h3 class="article-title">Memahami Trinitas Hindu: Brahma, Wisnu, Siwa</h3>
                        <p class="article-excerpt">Eksplorasi mendalam tentang tiga dewa utama dalam kosmologi Hindu...</p>
                        <a href="#" class="read-more">Baca Selengkapnya →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>Tentang Bookland</h3>
                    <p>Bookland adalah toko buku online yang berfokus pada literatur Hindu, menyediakan buku-buku berkualitas tentang filosofi, budaya, dan spiritualitas Hindu.</p>
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
        $(document).ready(function(){
            $('.books-slider').slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 4,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
            
            // Initialize articles slider
            $('.articles-slider').slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 3,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });
    </script>
        <script>
  document.getElementById('add-to-whatsapp').addEventListener('click', function () {
    const title = this.getAttribute('data-book-title');
    const price = this.getAttribute('data-price');

    const message = `Halo, saya tertarik dengan buku "${title}" seharga Rp${parseInt(price).toLocaleString('id-ID')}. Apakah masih tersedia?`;

    // Ganti nomor berikut dengan nomor admin Anda (tanpa 0 di awal, pakai 62)
    const phoneNumber = "6287762225026";

    const whatsappURL = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
    
    // Buka WhatsApp
    window.open(whatsappURL, '_blank');
  });
</script>
</body>
</html>