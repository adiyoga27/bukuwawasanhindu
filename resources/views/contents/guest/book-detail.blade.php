@extends('layouts.guest')
@section('css')
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $book->title }} | SantoBook</title>
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
        
        .btn-wishlist {
            background-color: white;
            color: var(--primary-color);
            padding: 12px 30px;
            font-weight: 600;
            border: 1px solid #ddd;
        }
        
        .btn-wishlist:hover {
            background-color: var(--light-color);
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

        .quantity-selector {
    display: flex;
    align-items: center; /* Ini yang paling penting untuk vertical alignment */
    margin-bottom: 20px;
}

.quantity-btn {
    width: 40px;
    height: 40px;
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    font-size: 1.2rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0; /* Pastikan tidak ada padding yang mengganggu */
    line-height: 1; /* Untuk teks di dalam button */
}

.quantity-input {
    width: 60px;
    height: 40px; /* Pastikan sama dengan height button */
    text-align: center;
    border: 1px solid #dee2e6;
    margin: 0 5px;
    font-size: 1rem;
    padding: 0.375rem 0.75rem; /* Padding standar Bootstrap */
    -moz-appearance: textfield; /* Hilangkan spinner di Firefox */
}

/* Hilangkan spinner di Chrome, Safari, Edge */
.quantity-input::-webkit-outer-spin-button,
.quantity-input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.quantity-btn:focus,
.quantity-input:focus {
    outline: none;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

   /* Floating Cart Button Styles */
    .floating-cart-container {
         position: fixed;
    bottom: 30px;
    right: 10px; /* INI YANG UTAMA */
    left: auto; /* Backup */
    z-index: 9999; /* dinaikkan untuk jaga-jaga */
    }
    
    .floating-cart-btn {
      display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
    background-color: #2c3e50;
    color: white;
    border-radius: 50%;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    text-decoration: none;
    position: relative;
    transition: all 0.3s ease;
    }
    
    .floating-cart-btn:hover {
        background-color: #e74c3c;
    transform: scale(1.1);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.3);
    }
   .cart-counter {
    position: absolute;
    top: -5px;
    right: -5px;
    background-color: #e74c3c;
    color: white;
    border-radius: 50%;
    width: 25px;
    height: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    font-weight: bold;
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
                <div class="col-lg-5">
                    <img src="{{ url('storage/'.$book->thumbnail) }}" class="img-fluid book-cover" alt="{{ $book['title'] }}">
                </div>
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
                         
                {{-- <div class="quantity-selector">
                    <button class="quantity-btn minus-btn" type="button">-</button>
                    <input type="number" class="quantity-input" id="quantity" name="quantity" value="1" min="1" max="{{ $book->getCountStock() }}">
                    <button class="quantity-btn plus-btn" type="button">+</button>
                    <span class="ms-2">(Max {{ $book->getCountStock() }} available)</span>
                </div> --}}
                    
               
                     <div class="d-flex mt-4">
                         <button
                                class="btn btn-add-to-whatsapp"
                                id="add-to-whatsapp"
                                data-book-id="{{ $book->id }}"
                                data-book-title="{{ $book->title }}"
                                data-price="{{ $book->discount > 0 ? $book->discount : $book->price }}">
                                <i class="fab fa-whatsapp text-success me-2"></i> WhatsApp
                            </button>
                    {{-- <button class="btn btn-add-to-cart" id="add-to-cart" data-book-id="{{ $book->id }}">
                        <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                    </button> --}}
                 
                </div>
                </div>
            </div>
            
            {{-- <div class="book-description">
                <h3 class="mb-4">Description</h3>
                <p>{{ $book['long_description'] }}</p>
            </div> --}}
            
            <div class="related-books">
                <h3 class="mb-4">Related Books</h3>
                <div class="row">
                    @foreach($relatedBooks as $relatedBook)
                        <div class="col-md-4">
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
                <!-- Tambahkan di bagian sebelum </body> atau di section scripts -->
{{-- <div class="floating-cart-container">
    <a href="{{ route('cart.index') }}" class="floating-cart-btn">
        <i class="fas fa-shopping-cart"></i>
        <span class="cart-counter">{{ count(session('cart', [])) }}</span>
    </a>
</div> --}}
@section('js')
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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