@extends('layouts/guest')
@section('css')
    <title>Kontak - Buku Wawasan Hindu</title>

      <style>
        :root {
            --primary: #4f6cec;
            --secondary: #121f5a;
            --dark: #292f36;
            --light: #f7fff7;
            --accent: #ffd166;
            --facebook: #3b5998;
            --instagram: #e1306c;
            --youtube: #ff0000;
            --tiktok: #010101;
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

        .contact-card {
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: none;
        }

        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .contact-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .social-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 8px;
            transition: all 0.3s ease;
            color: white !important;
            font-size: 1.2rem;
        }

        .social-icon.facebook {
            background-color: var(--facebook);
        }

        .social-icon.instagram {
            background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
        }

        .social-icon.youtube {
            background-color: var(--youtube);
        }

        .social-icon.tiktok {
            background-color: var(--tiktok);
        }

        .social-icon:hover {
            transform: translateY(-5px) scale(1.1);
        }

        .map-container {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            height: 100%;
        }

        footer {
            background: var(--dark);
            color: white;
        }

        @media (max-width: 768px) {
            .contact-hero {
                height: 200px;
            }
            
            .social-icon {
                width: 45px;
                height: 45px;
                margin: 0 5px;
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

    <!-- Contact Information -->
    <section class="py-5 my-5">
        <div class="container">
            <div class="row g-4">
                <!-- Contact Card 1 -->
                <div class="col-md-4">
                    <div class="contact-card card h-100 p-4 text-center">
                        <div class="contact-icon bg-success text-white mx-auto">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <h3>WhatsApp</h3>
                        <p class="text-muted">Hubungi kami melalui WhatsApp</p>
                        <div class="mt-3">
                            <a href="https://wa.me/{{ $configs->phone }}" class="btn btn-outline-success rounded-pill px-4">
                                <i class="fas fa-phone-alt me-2"></i>+{{ $configs->phone }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Contact Card 2 -->
                <div class="col-md-4">
                    <div class="contact-card card h-100 p-4 text-center">
                        <div class="contact-icon bg-primary text-white mx-auto">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3>Email</h3>
                        <p class="text-muted">Kirim pesan melalui email</p>
                        <div class="mt-3">
                            <a href="admin@bukuwawasanhindu.com" class="btn btn-outline-primary rounded-pill px-4">
                                <i class="fas fa-envelope me-2"></i>{{ $configs->email }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Contact Card 3 -->
                <div class="col-md-4">
                    <div class="contact-card card h-100 p-4 text-center">
                        <div class="contact-icon bg-warning text-dark mx-auto">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3>Lokasi</h3>
                        <p class="text-muted">Kunjungi toko fisik kami</p>
                        <div class="mt-3">
                            <a href="#map" class="btn btn-outline-warning rounded-pill px-4">
                                <i class="fas fa-map-marker-alt me-2"></i>Lihat Peta
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Social Media Section -->
    <section class="py-5 bg-light">
        <div class="container text-center">
            <h2 class="mb-5">Ikuti Kami di Media Sosial</h2>
            <div class="d-flex justify-content-center flex-wrap">
                <a href="#" class="social-icon facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="social-icon instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="social-icon youtube">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="#" class="social-icon tiktok">
                    <i class="fab fa-tiktok"></i>
                </a>
            </div>
            <div class="mt-4">
                <p class="text-muted">Tetap terhubung dengan kami untuk update terbaru</p>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section id="map" class="py-5 my-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="mb-4">Lokasi Toko Kami</h2>
                    <p class="lead">Kunjungi toko fisik kami untuk melihat koleksi buku secara langsung dan bertemu dengan tim kami.</p>
                    <div class="mt-4">
                        <p><i class="fas fa-map-marker-alt text-primary me-2"></i> {{ $configs->address }}</p>
                        <p><i class="fas fa-clock text-primary me-2"></i> Buka setiap hari: 09.00 - 17.00 WITA</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.016230518094!2d115.21841431478192!3d-8.6836851937646!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd2408808c9f9c3%3A0x6a1b3b7d1b0b0b0b!2sDenpasar%2C%20Bali!5e0!3m2!1sen!2sid!4v1620000000000!5m2!1sen!2sid" 
                                width="100%" 
                                height="300" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-body p-5">
                            <h2 class="text-center mb-4">Kirim Pesan kepada Kami</h2>
                            <form>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Alamat Email</label>
                                        <input type="email" class="form-control" id="email" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="subject" class="form-label">Subjek</label>
                                        <input type="text" class="form-control" id="subject" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="message" class="form-label">Pesan</label>
                                        <textarea class="form-control" id="message" rows="5" required></textarea>
                                    </div>
                                    <div class="col-12 text-center mt-4">
                                        <button type="submit" class="btn btn-primary btn-lg px-5">
                                            <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
   