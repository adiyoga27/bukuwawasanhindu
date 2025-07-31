@extends('layouts.guest')
@section('css')

     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $book->title }} | Buku Wawasan Hindu</title>
    {{-- Buatkan meta data untuk SEO, title, description, keywords, author, publisher, dan lain-lain . deskripsi ambil 100 kata saja dan isi titik titik ... --}} 
    <link rel="canonical" href="{{ url('product/'.$book->slug) }}">
    <meta name="description" content="{{ Str::limit(strip_tags($book->description), 225, '...') }}">
    <meta name="keywords" content="Ebook, SantoBook, Kandapat">
    <meta name="author" content="Buku Wawasan Hindu">
    <meta name="title" content="{{ $book->title }} ">
    <meta name="image" content="{{ url('storage/') }}/{{ $book->thumbnail }}">

    <meta property="og:title" content="{{ $book->title }} | SantoBook">
    <meta property="og:description" content="{{ Str::limit(strip_tags($book->description), 225, '...') }}">
    <meta property="og:image" content="{{ url('storage/') }}/{{ $book->thumbnail }}">
    <meta property="og:url" content="{{ url('product/'.$book->slug) }}">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $book->title }} | SantoBook">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($book->description), 225, '...') }}">
    <meta name="twitter:image" content="{{ url('path/to/book-image.jpg') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css">
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
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .book-detail {
            padding: 50px 0;
        }
        
        .book-cover {
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
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
        .btn-add-to-whatsapp:hover{
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
        
        .related-book-card {
            transition: all 0.3s;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .related-book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
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
            background: rgba(0,0,0,0.5);
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
            background: rgba(0,0,0,0.8);
        }
        
        
       

/* Animasi */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.2); }
    100% { transform: scale(1); }
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
@endsection
@section('content')
    <div class="container">
    <div class="row">
        <!-- Product Gallery Column - Now side by side -->
        <div class="col-lg-5">
            <div class="product-gallery-container">
                <!-- Main Image -->
                <div class="main-image-wrapper">
                    <img src="{{ url('storage/'.$book->thumbnail) }}" class="main-product-image" alt="{{ $book['title'] }}" id="mainProductImage">
                </div>
                
                <!-- Thumbnail Slider -->
                <div class="thumbnail-slider-container">
                    <div class="thumbnail-slider">
                        <!-- Include thumbnail as first image -->
                        <div class="thumbnail-slide">
                            <img src="{{ url('storage/'.$book->thumbnail) }}" class="thumbnail-image" alt="Thumbnail">
                        </div>
                        
                        <!-- Gallery Images -->
                        @foreach($book->galleries as $gallery)
                        <div class="thumbnail-slide">
                            <img src="{{ Storage::url($gallery->image_path) }}" class="thumbnail-image" alt="Gallery Image {{ $loop->iteration }}">
                        </div>
                        @endforeach
                    </div>
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
                <span class="text-muted">(120 reviews)</span>
            </div>
            
            <div class="price-section">
                <span class="current-price">Rp {{ number_format(($book->discount > 0 ? $book->discount : $book->price), 0, ',', '.') }}</span>
                <span class="original-price">Rp {{ number_format($book['price'], 0, ',', '.') }}</span>
                <span class="discount-badge">Save {{ ($book->price - $book->discount)/$book->price * 100 }}%</span>
            </div>
            
            {!! $book['description'] !!}
            
            <div class="d-flex mt-4">
                <button class="btn btn-add-to-whatsapp"
                    id="add-to-whatsapp"
                    data-book-id="{{ $book->id }}"
                    data-book-title="{{ $book->title }}"
                    data-price="{{ $book->discount > 0 ? $book->discount : $book->price }}">
                    <i class="fab fa-whatsapp text-success me-2"></i> WhatsApp
                </button>
            </div>
        </div>
    </div>
    
    <!-- Related Books Section -->
    <div class="related-books mt-5">
        <h3 class="mb-4">Related Books</h3>
        <div class="row">
            @foreach($relatedBooks as $relatedBook)
                <div class="col-md-4 mb-4">
                    <div class="card related-book-card">
                        <img src="{{ url('storage/') }}/{{ $relatedBook['thumbnail'] }}" class="card-img-top" alt="{{ $relatedBook['title'] }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $relatedBook['title'] }}</h5>
                            <p class="card-text text-muted">{{ $relatedBook['author'] }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold">Rp {{ number_format($relatedBook['price'], 0, ',', '.') }}</span>
                                <span class="badge bg-warning text-dark">
                                    <i class="fas fa-star"></i> {{ $relatedBook['rating'] }}
                                </span>
                            </div>
                            <a href="{{ url('product/'.$relatedBook['slug']) }}" class="btn btn-primary mt-3 w-100">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
        @endsection

@section('js')
<!-- Then load Slick slider -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Then load Slick slider -->
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

      <script>
        $(document).ready(function() {
              // Initialize thumbnail slider
    $('.thumbnail-slider').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: true,
        arrows: true,
        prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });
    
    // Change main image when thumbnail is clicked
    $('.thumbnail-image').click(function(){
        const newSrc = $(this).attr('src');
        $('#mainProductImage').attr('src', newSrc);
        
        // Update active state
        $('.thumbnail-slide').removeClass('slick-current');
        $(this).closest('.thumbnail-slide').addClass('slick-current');
    });

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

@endsection