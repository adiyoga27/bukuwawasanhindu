@extends('layouts.guest')
@section('css')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $book->title }} | Buku Wawasan Hindu</title>
    {{-- Buatkan meta data untuk SEO, title, description, keywords, author, publisher, dan lain-lain . deskripsi ambil 100 kata saja dan isi titik titik ... --}}
    <link rel="canonical" href="{{ url('product/' . $book->slug) }}">
    <meta name="description" content="{{ Str::limit(strip_tags($book->description), 225, '...') }}">
    <meta name="keywords" content="Ebook, Buku Wawasan Hindu, Kandapat">
    <meta name="author" content="Buku Wawasan Hindu">
    <meta name="title" content="{{ $book->title }} ">
    <meta name="image" content="{{ url('storage/') }}/{{ $book->thumbnail }}">

    <meta property="og:title" content="{{ $book->title }} | Buku Wawasan Hindu">
    <meta property="og:description" content="{{ Str::limit(strip_tags($book->description), 225, '...') }}">
    <meta property="og:image" content="{{ url('storage/') }}/{{ $book->thumbnail }}">
    <meta property="og:url" content="{{ url('product/' . $book->slug) }}">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $book->title }} | Buku Wawasan Hindu">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($book->description), 225, '...') }}">
    <meta name="twitter:image" content="{{ url('path/to/book-image.jpg') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="icon" href="{{ url('assets/images/favicon.png') }}" type="image/x-icon">
<link rel="shortcut icon" href="{{ url('assets/images/favicon.png') }}" type="image/x-icon">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #34495e;
            --accent-color: #e74c3c;
            --green-color: #34cf20;
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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .book-detail {
            padding: 50px 0;
        }

        .book-cover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        .book-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .book-author {
            font-size: 1.2rem;
            color: var(--secondary-color);
            margin-bottom: 20px;
        }

        .price-section {
            margin: 30px 0;
        }

        .current-price {
            font-size: 2rem;
            font-weight: 700;
            color: var(--accent-color);
        }

        .original-price {
            font-size: 1.2rem;
            text-decoration: line-through;
            color: #6c757d;
            margin-left: 10px;
        }

        .discount-badge {
            background-color: var(--accent-color);
            color: white;
            padding: 5px 15px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 1.1rem;
            margin-left: 15px;
        }

        .book-meta {
            margin: 30px 0;
        }

        .meta-item {
            margin-bottom: 15px;
        }

        .meta-label {
            font-weight: 600;
            color: var(--primary-color);
            display: inline-block;
            width: 120px;
        }

        .btn-add-to-whatsapp {
            background-color: var(--green-color);
            color: white;
            padding: 12px 30px;
            font-weight: 600;
            border: none;
            margin-right: 15px;
        }

        .btn-add-to-whatsapp:hover {
            background-color: #1abe0b;
            color: white;
        }

        .btn-add-to-cart {
            background-color: var(--accent-color);
            color: white;
            padding: 12px 30px;
            font-weight: 600;
            border: none;
            margin-right: 15px;
        }

        .btn-add-to-cart:hover {
            background-color: #c0392b;
            color: white;
        }

        .book-description {
            margin: 50px 0;
            line-height: 1.8;
        }

        .related-books {
            margin-top: 50px;
        }
.related-books .card.related-book-card {
    padding: 10px;
    font-size: 0.9rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.related-books .card.related-book-card .card-img-top {
    height: 160px;
    object-fit: cover;
    border-radius: 6px;
}

.related-books .card.related-book-card .card-title {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 6px;
}

.related-books .card.related-book-card .card-text {
    font-size: 0.85rem;
    margin-bottom: 8px;
}

.related-books .card.related-book-card .btn {
    font-size: 0.85rem;
    padding: 6px 10px;
}

        /* Add these new styles for the gallery */
        .product-gallery {
            position: relative;
        }

        .main-image-container {
            margin-bottom: 15px;
            border: 1px solid #eee;
            border-radius: 8px;
            overflow: hidden;
        }

        .main-product-image {
            width: 100%;
            height: auto;
            display: block;
            cursor: zoom-in;
        }

        /* Add these styles for the gallery */
        .product-gallery-container {
            display: flex;
            flex-direction: column;
        }

        .main-image-wrapper {
            margin-bottom: 15px;
            border: 1px solid #eee;
            border-radius: 8px;
            overflow: hidden;
        }

        .main-product-image {
            width: 100%;
            height: auto;
            display: block;
        }

        .thumbnail-slider-container {
            position: relative;
        }

        .thumbnail-slider {
            margin: 0 30px;
        }

        .thumbnail-slide {
            padding: 0 5px;
            cursor: pointer;
        }

        .thumbnail-image {
            width: 100%;
            height: 80px;
            object-fit: cover;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .thumbnail-slide.slick-current .thumbnail-image,
        .thumbnail-image:hover {
            border-color: #e74c3c;
        }

        .slick-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 30px;
            height: 30px;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
            cursor: pointer;
            border: none;
        }

        .slick-prev {
            left: 0;
        }

        .slick-next {
            right: 0;
        }

        .slick-arrow:hover {
            background: rgba(0, 0, 0, 0.8);
        }




        /* Animasi */
        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
        }

        .cart-pulse {
            animation: pulse 0.5s ease;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .floating-cart-container {
                bottom: 20px;
                right: 10px;
            }

            .floating-cart-btn {
                width: 50px;
                height: 50px;
            }

            .cart-counter {
                width: 20px;
                height: 20px;
            }
        }
    </style>
    <style>
        .thumbnail-img {
            height: 70px;
            object-fit: cover;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .thumbnail-img.active {
            border-color: #0d6efd;
        }

        .marketplace-links {
    margin-top: 1.5rem;
}

.marketplace-links h3 {
    font-size: 1.2rem;
    margin-bottom: 1rem;
    color: #333;
    font-weight: 600;
}

.marketplace-link {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    margin-bottom: 0.75rem;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
    background-color: #f8f9fa;
    border: 1px solid #e9ecef;
}

.marketplace-link:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.marketplace-link span {
    margin-left: 10px;
    font-weight: 500;
}

/* Warna khusus untuk setiap marketplace */
.shopee-link {
    background-color: #f5f5f5;
    border-left: 4px solid #ee4d2d;
}

.tokopedia-link {
    background-color: #f5f5f5;
    border-left: 4px solid #42b549;
}

.lazada-link {
    background-color: #f5f5f5;
    border-left: 4px solid #0f146d;
}

/* Tombol WhatsApp */
.btn-add-to-whatsapp {
    background-color: #25D366;
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
    border: none;
}

.btn-add-to-whatsapp:hover {
    background-color: #128C7E;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

/* Responsive */
@media (max-width: 768px) {
    .marketplace-link {
        padding: 0.6rem 0.8rem;
    }
    
    .marketplace-logo {
        width: 35px !important;
    }
}
 /* Add these styles to your existing CSS */
    .carousel-indicators-right {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        display: flex;
        flex-direction: column;
        gap: 10px;
        z-index: 2;
    }

    /* Adjust navigation arrows */
    .carousel-control-prev,
    .carousel-control-next {
        width: 40px;
        height: 40px;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0, 0, 0, 0.3);
        border-radius: 50%;
    }

    .carousel-control-prev {
        left: 15px;
    }

    .carousel-control-next {
        right: 15px;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 1.5rem;
        height: 1.5rem;
    }

    </style>
@endsection
@section('content')
    <!-- Hero Section -->
    <div class="mt-4"></div>
    <div class="container">
        <div class="row">
            <!-- Product Gallery Column - Now side by side -->
            <div class="col-lg-5">
<div class="container py-4">
    <!-- Carousel -->
    <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ Storage::url($book->thumbnail) }}" class="d-block w-100" alt="Thumbnail Utama">
            </div>
            @foreach ($book->galleries as $gallery)
                <div class="carousel-item">
                    <img src="{{ Storage::url($gallery->image_path) }}" class="d-block w-100" alt="Gallery Image">
                </div>
            @endforeach
        </div>

        <!-- Custom right-aligned indicators -->
        {{-- <div class="carousel-indicators-right">
            @foreach ($book->galleries as $index => $gallery)
                <button type="button" data-bs-target="#mainCarousel" 
                        data-bs-slide-to="{{ $index }}" 
                        class="{{ $loop->first ? 'active' : '' }}">
                </button>
            @endforeach
        </div> --}}

        <!-- Navigation arrows -->
        <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Thumbnails -->
    <div class="mt-3 d-flex justify-content-center gap-2 flex-wrap">
        <img src="{{ Storage::url($book->thumbnail) }}" class="thumbnail-img" data-bs-target="#mainCarousel" data-bs-slide-to="0">
        @foreach ($book->galleries as $index => $gallery)
            <img src="{{ Storage::url($gallery->image_path) }}" class="thumbnail-img" data-bs-target="#mainCarousel" data-bs-slide-to="{{ $index + 1 }}">
        @endforeach
    </div>
</div>


            </div>

            <!-- Product Info Column -->
            <div class="col-lg-7">
                <h1 class="book-title">{{ $book['title'] }}</h1>
                <p class="book-author">By {{ $book['author'] }}</p>

                <div class="rating mb-3">
                    <span class="badge bg-warning text-dark me-2">
                        <i class="fas fa-star"></i> {{ $book['rating'] }}
                    </span>
                    <span class="text-muted">(Sisa Stock : {{ $book->getCountStock() }} pcs)</span>
                </div>

                <div class="price-section">
                    <span class="current-price">Rp
                        {{ number_format($book->discount > 0 ? $book->discount : $book->price, 0, ',', '.') }}</span>
                    <span class="original-price">Rp {{ number_format($book['price'], 0, ',', '.') }}</span>
                    <span class="discount-badge">Diskon {{ number_format((($book->price - $book->discount) / $book->price) * 100, 0,',','.') }}%</span>
                </div>

                {!! $book['description'] !!}
<div class="mt-4 ">
    <p  class="fst-italic"> Tags : {{$book->keyword }}</p>
</div>
                <!-- Marketplace Links Section -->
<div class="marketplace-links mt-4">
    <h3 class="mb-3">Link Pembelian</h3>
    
    <div class="d-flex flex-column gap-2">
        @if ($book->shopee)
            <a href="{{ $book->shopee }}" target="_blank" class="marketplace-link shopee-link">
                <img width="45" src="{{ url('assets/images/shopee.svg') }}" alt="Shopee" class="marketplace-logo">
                <span>Beli di Shopee</span>
            </a>
        @endif
        
        @if ($book->tokopedia)
            <a href="{{ $book->tokopedia }}" target="_blank" class="marketplace-link tokopedia-link">
                <img width="45" src="{{ url('assets/images/tokopedia.svg') }}" alt="Tokopedia" class="marketplace-logo">
                <span>Beli di Tokopedia</span>
            </a>
        @endif
        
        @if ($book->lazada)
            <a href="{{ $book->lazada }}" target="_blank" class="marketplace-link lazada-link">
                <img width="45" src="{{ url('assets/images/lazada.webp') }}" alt="Lazada" class="marketplace-logo">
                <span>Beli di Lazada</span>
            </a>
        @endif
    </div>

    <div class="mt-3">
        <button class="btn btn-add-to-whatsapp w-100" id="add-to-whatsapp" 
                data-book-id="{{ $book->id }}"
                data-book-title="{{ $book->title }}"
                data-price="{{ $book->discount > 0 ? $book->discount : $book->price }}">
            <i class="fab fa-whatsapp me-2"></i> Hubungi via WhatsApp
        </button>
    </div>
</div>
            </div>

            <!-- Related Books Section -->
            <div class="related-books mt-5">
                <h3 class="mb-4">Related Books</h3>
                <div class="row">
                    @foreach ($relatedBooks as $relatedBook)
                        <div class="col-md-4 mb-4">
                            <div class="card related-book-card">
                                <img src="{{ url('storage/') }}/{{ $relatedBook['thumbnail'] }}" class="card-img-top"
                                    alt="{{ $relatedBook['title'] }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $relatedBook['title'] }}</h5>
                                    <p class="card-text text-muted">{{ $relatedBook['author'] }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold">Rp
                                            {{ number_format($relatedBook['price'], 0, ',', '.') }}</span>
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-star"></i> {{ $relatedBook['rating'] }}
                                        </span>
                                    </div>
                                    <a href="{{ url('product/' . $relatedBook['slug']) }}"
                                        class="btn btn-primary mt-3 w-100">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Then load Slick slider -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Tambahkan efek aktif pada thumbnail
        const thumbnails = document.querySelectorAll('.thumbnail-img');
        const carousel = document.querySelector('#mainCarousel');

        thumbnails.forEach((thumb, index) => {
            thumb.addEventListener('click', () => {
                thumbnails.forEach(t => t.classList.remove('active'));
                thumb.classList.add('active');
            });
        });

        // Update thumbnail aktif saat slide berubah
        const bsCarousel = new bootstrap.Carousel(carousel);
        carousel.addEventListener('slid.bs.carousel', function(e) {
            thumbnails.forEach(t => t.classList.remove('active'));
            thumbnails[e.to].classList.add('active');
        });
document.addEventListener('DOMContentLoaded', function() {
        const thumbnails = document.querySelectorAll('.thumbnail-img');
        const indicators = document.querySelectorAll('.carousel-indicators-right button');
        const carousel = document.querySelector('#mainCarousel');
        
        // Initialize first thumbnail and indicator as active
        thumbnails[0].classList.add('active');
        indicators[0].classList.add('active');
        
        thumbnails.forEach((thumb, index) => {
            thumb.addEventListener('click', () => {
                thumbnails.forEach(t => t.classList.remove('active'));
                indicators.forEach(i => i.classList.remove('active'));
                thumb.classList.add('active');
                indicators[index].classList.add('active');
            });
        });
        
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                thumbnails.forEach(t => t.classList.remove('active'));
                indicators.forEach(i => i.classList.remove('active'));
                thumbnails[index].classList.add('active');
                indicator.classList.add('active');
            });
        });
        
        // Update active states when slide changes
        const bsCarousel = new bootstrap.Carousel(carousel);
        carousel.addEventListener('slid.bs.carousel', function(e) {
            thumbnails.forEach(t => t.classList.remove('active'));
            indicators.forEach(i => i.classList.remove('active'));
            thumbnails[e.to].classList.add('active');
            indicators[e.to].classList.add('active');
        });
    });
    </script>
    <script>
        $(document).ready(function() {


            // Quantity selector logic
            $('.minus-btn').click(function() {

                var input = $('#quantity');
                var value = parseInt(input.val());
                if (value > 1) {
                    input.val(value - 1);
                }
            });

            $('.plus-btn').click(function() {
                var input = $('#quantity');
                var value = parseInt(input.val());

                var max = parseInt(input.attr('max'));

                if (value < max) {
                    input.val(value + 1);
                }
            });

            // Add to cart functionality
            $('#add-to-cart').click(function() {
                var bookId = $(this).data('book-id');
                var quantity = $('#quantity').val();

                $.ajax({
                    url: window.location.origin + '/cart/add',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        book_id: bookId,
                        quantity: quantity
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#cart-success').fadeIn().delay(3000).fadeOut();
                            // Update cart count in navbar if you have one
                            if (response.cart_count) {
                                $('.cart-count').text(response.cart_count);
                            }
                        }
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr.responseJSON.message);
                    }
                });
            });


        });
        // Animasi ketika item ditambahkan ke cart
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk update counter
            function updateCartCounter(count) {
                const counter = document.querySelector('.cart-counter');
                counter.textContent = count;

                // Tambahkan animasi
                counter.classList.add('cart-pulse');
                setTimeout(() => {
                    counter.classList.remove('cart-pulse');
                }, 500);
            }

            // Jika menggunakan AJAX untuk add to cart
            $(document).on('click', '#add-to-cart', function() {
                // Setelah AJAX success, update counter
                // Contoh:
                // updateCartCounter(newCount);
            });
        });
    </script>
    <script>
        document.getElementById('add-to-whatsapp').addEventListener('click', function() {
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
    </script>
@endsection
