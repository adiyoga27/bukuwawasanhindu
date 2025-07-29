<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookland - Best Store Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @yield('css')
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
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <span><i class="fas fa-envelope me-2"></i> info@bookland.com</span>
                </div>
                <div class="col-md-6 text-end">
                    <span><i class="fas fa-phone me-2"></i> +62 123 456 7890</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3" href="#">
                <span class="text-primary">Book</span><span class="text-danger">land</span>
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
                        <a class="nav-link" href="{{ url('article') }}">Artikel</a>
                    </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{ url('book') }}">Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Best Store Website</h1>
            <p class="lead mb-5">Find your next favorite book from our extensive collection</p>
            
            <div class="search-box">
                <div class="input-group mb-3">
                    <input type="text" class="form-control form-control-lg" placeholder="Search Books Here...">
                    <button class="btn btn-danger btn-lg" type="button"><i class="fas fa-search"></i> Search</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container py-5">
        <div class="row">

            @yield('content')

             </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">Kategori</h5>
                    <p>Best Store Website for book lovers. Find your next favorite book from our extensive collection.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Home</a></li>
                        <li><a href="#" class="text-white">Shop</a></li>
                        <li><a href="#" class="text-white">Blog</a></li>
                        <li><a href="#" class="text-white">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">Contact Us</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-map-marker-alt me-2"></i> Jakarta, Indonesia</li>
                        <li><i class="fas fa-phone me-2"></i> +62 123 456 7890</li>
                        <li><i class="fas fa-envelope me-2"></i> info@bookland.com</li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p class="mb-0">&copy; 2023 Bookland. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('js')
</body>
</html>