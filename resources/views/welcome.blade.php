<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bacaanhindu - Toko Buku Agama Hindu</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: #0056b3; /* Democratic blue */
            --secondary-blue: #003d82;
            --light-blue: #e6f0ff;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            background-color: var(--primary-blue);
        }
        
        .navbar-brand, .nav-link {
            color: white !important;
        }
        
        .btn-primary {
            background-color: var(--primary-blue);
            border-color: var(--primary-blue);
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-blue);
            border-color: var(--secondary-blue);
        }
        
        .card {
            transition: transform 0.3s;
            margin-bottom: 20px;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .sidebar {
            background-color: var(--light-blue);
            border-radius: 5px;
            padding: 15px;
        }
        
        .sidebar-title {
            color: var(--primary-blue);
            border-bottom: 2px solid var(--primary-blue);
            padding-bottom: 5px;
        }
        
        .sidebar-list {
            list-style: none;
            padding-left: 0;
        }
        
        .sidebar-list li {
            padding: 5px 0;
            border-bottom: 1px solid #dee2e6;
        }
        
        .sidebar-list li:last-child {
            border-bottom: none;
        }
        
        .sidebar-list li a {
            color: #333;
            text-decoration: none;
        }
        
        .sidebar-list li a:hover {
            color: var(--primary-blue);
        }
        
        .price-old {
            text-decoration: line-through;
            color: #6c757d;
        }
        
        .price-new {
            color: var(--primary-blue);
            font-weight: bold;
        }
        
        .badge-popular {
            background-color: #ffc107;
            color: #000;
        }
        
        .info-box {
            background-color: var(--light-blue);
            border-left: 4px solid var(--primary-blue);
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 0 5px 5px 0;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Bacaanhindu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-home me-1"></i> Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-book me-1"></i> Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-info-circle me-1"></i> Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-phone me-1"></i> Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">767 produk ditemukan</h2>
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown">
                            Urutkan
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Popular</a></li>
                            <li><a class="dropdown-item" href="#">Termurah</a></li>
                            <li><a class="dropdown-item" href="#">Termahal</a></li>
                            <li><a class="dropdown-item" href="#">Terbaru</a></li>
                        </ul>
                    </div>
                </div>

                <div class="info-box">
                    <h5 class="fw-bold">Membantu Umat dalam Memahami Agama Hindu</h5>
                    <p>Klik <a href="#" class="fw-bold">MEKU</a> untuk melihat jenis-jenis Bukunya ya.</p>
                    <p class="mb-0"><small>*Sikk tenedita = sikk banyak<br>*Sikk terbat angkanya (cth: slot, 6) = chat admin jika mau order banyak.</small></p>
                </div>

                <div class="row">
                    <!-- Product 1 -->
                    <div class="col-md-4">
                        <div class="card h-100">
                            <span class="badge badge-popular position-absolute top-0 start-0 m-2">Popular</span>
                            <img src="https://via.placeholder.com/200x250" class="card-img-top" alt="Buku Mapandes Potong Gigi">
                            <div class="card-body">
                                <h5 class="card-title">Buku Mapandes Potong Gigi</h5>
                                <p class="card-text text-muted">Agama Hindu | Ketut Pasek Swastika (Buat)</p>
                                <p class="card-text"><small class="text-muted"><i class="fas fa-star text-warning"></i> Sikk Tenedita 19</small></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="price-old">Rp 70.000</span><br>
                                        <span class="price-new">Rp 60.000</span>
                                    </div>
                                    <button class="btn btn-sm btn-primary">Beli</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product 2 -->
                    <div class="col-md-4">
                        <div class="card h-100">
                            <img src="https://via.placeholder.com/200x250" class="card-img-top" alt="Buku Ramalan Sagha Pudjangga">
                            <div class="card-body">
                                <h5 class="card-title">Buku Ramalan Sagha Pudjangga</h5>
                                <p class="card-text text-muted">Digibolog Boragovavarillo Sabdupalon Agama Hindu Iwa Glok Djing (Buat)</p>
                                <p class="card-text"><small class="text-muted"><i class="fas fa-star text-warning"></i> Sikk Tenedita 12</small></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="price-old">Rp 100.000</span><br>
                                        <span class="price-new">Rp 65.000</span>
                                    </div>
                                    <button class="btn btn-sm btn-primary">Beli</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product 3 -->
                    <div class="col-md-4">
                        <div class="card h-100">
                            <span class="badge badge-popular position-absolute top-0 start-0 m-2">Popular</span>
                            <img src="https://via.placeholder.com/200x250" class="card-img-top" alt="Buku Kamus Nama Nama">
                            <div class="card-body">
                                <h5 class="card-title">Buku Kamus Nama Nama</h5>
                                <p class="card-text text-muted">Samderfa Indonesia Agama Hindu AA Ngarah Prima Surya Vijayya (Buat)</p>
                                <p class="card-text"><small class="text-muted"><i class="fas fa-star text-warning"></i> Sikk Tenedita 18</small></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="price-old">Rp 70.000</span><br>
                                        <span class="price-new">Rp 65.000</span>
                                    </div>
                                    <button class="btn btn-sm btn-primary">Beli</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-3">
                <div class="sidebar mb-4">
                    <h5 class="sidebar-title">Menu</h5>
                    <ul class="sidebar-list">
                        <li><a href="#">Semua Kategori</a></li>
                        <li><a href="#">Babad</a></li>
                        <li><a href="#">Balan</a></li>
                        <li><a href="#">Banten</a></li>
                        <li><a href="#">Bhuta Yadnya</a></li>
                        <li><a href="#">Dewa Yadnya</a></li>
                        <li><a href="#">Doa</a></li>
                        <li><a href="#">Filsafat</a></li>
                        <li><a href="#">Genggaman</a></li>
                        <li><a href="#">Kalender</a></li>
                        <li><a href="#">Karma</a></li>
                        <li><a href="#">Karola Empot</a></li>
                    </ul>
                </div>

                <div class="sidebar mb-4">
                    <h5 class="sidebar-title">Kategori Populer</h5>
                    <ul class="sidebar-list">
                        <li><a href="#">Semra</a></li>
                        <li><a href="#">Popular</a></li>
                        <li><a href="#">Tirtaru</a></li>
                    </ul>
                </div>

                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Butuh Bantuan?</h5>
                        <p class="card-text">Hubungi kami untuk pertanyaan tentang produk atau pemesanan.</p>
                        <button class="btn btn-primary btn-sm"><i class="fab fa-whatsapp me-1"></i> Chat Admin</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white mt-5 py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5>Tentang Bacaanhindu</h5>
                    <p>Toko buku online khusus literatur agama Hindu. Menyediakan berbagai buku untuk mendukung pemahaman dan praktik keagamaan.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Kontak Kami</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-phone me-2"></i> +62 123 4567 890</li>
                        <li><i class="fas fa-envelope me-2"></i> info@bacaanhindu.com</li>
                        <li><i class="fas fa-map-marker-alt me-2"></i> Denpasar, Bali</li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Ikuti Kami</h5>
                    <div class="social-links">
                        <a href="#" class="text-white me-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p class="mb-0">&copy; 2023 Bacaanhindu. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>