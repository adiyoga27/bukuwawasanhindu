@extends('layouts.guest')
@section('title', 'Keranjang Belanja')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Daftar Produk -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0 py-3">
                    <h2 class="h4 mb-0"><i class="fas fa-shopping-cart text-primary me-2"></i>Keranjang Belanja</h2>
                </div>
                
                <div class="card-body px-0">
                    @if(!empty($products) && count($products) > 0)
                        @foreach($products as $product)
                        <div class="cart-item px-3 py-3 border-bottom">
                            <div class="row align-items-center">
                                <!-- Gambar Produk -->
                                <div class="col-3 col-md-2">
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}" 
                                         alt="{{ $product->title }}" 
                                         class="img-fluid rounded-3 shadow-sm">
                                </div>
                                
                                <!-- Detail Produk -->
                                <div class="col-9 col-md-6">
                                    <h5 class="h6 mb-1 fw-bold">{{ Str::limit($product->title, 35) }}</h5>
                                    <p class="small text-muted mb-2">by {{ $product->author }}</p>
                                    
                                    <!-- Harga -->
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="text-danger fw-bold me-2">
                                            Rp {{ number_format($product->discount > 0 ? $product->discount : $product->price, 0, ',', '.') }}
                                        </span>
                                        @if($product->discount > 0)
                                            <small class="text-decoration-line-through text-muted">
                                                Rp {{ number_format($product->price, 0, ',', '.') }}
                                            </small>
                                        @endif
                                    </div>
                                    
                                    <!-- Stok -->
                                    <span class="badge bg-light text-dark small mb-2">
                                        <i class="fas fa-box-open me-1"></i> Stok: {{ $product->getCountStock() }}
                                    </span>
                                </div>
                                
                                <!-- Quantity -->
                                <div class="col-6 col-md-2 mt-3 mt-md-0">
                                    <form action="{{ route('cart.update') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="book_id" value="{{ $product->id }}">
                                        <div class="input-group input-group-sm">
                                            <button class="btn btn-outline-secondary minus-btn" type="button">-</button>
                                            <input type="number" 
                                                   name="quantity" 
                                                   value="{{ $product->quantity }}" 
                                                   min="1" 
                                                   max="{{ $product->current_stock }}"
                                                   class="form-control text-center" id="quantity">
                                            <button class="btn btn-outline-secondary plus-btn" type="button">+</button>
                                        </div>
                                        {{-- <button type="submit" class="btn btn-link p-0 small mt-1 text-primary">Update</button> --}}
                                    </form>
                                </div>
                                
                                <!-- Subtotal & Hapus -->
                                <div class="col-6 col-md-2 text-end mt-3 mt-md-0">
                                    <p class="fw-bold mb-1">
                                        Rp {{ number_format(($product->discount > 0 ? $product->discount : $product->price) * $product->quantity, 0, ',', '.') }}
                                    </p>
                                    <form action="{{ route('cart.remove', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-link text-danger p-0">
                                            <small><i class="fas fa-trash-alt me-1"></i> Hapus</small>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <!-- Tampilan keranjang kosong -->
                        <div class="text-center py-5">
                            <i class="fas fa-shopping-cart fa-4x text-muted mb-4"></i>
                            <h4>Keranjang Anda kosong</h4>
                            <p class="text-muted">Mulai berbelanja untuk menambahkan produk</p>
                            <a href="{{ url('/') }}" class="btn btn-primary mt-3">
                                <i class="fas fa-arrow-left me-2"></i> Lanjutkan Belanja
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Ringkasan & Form Penerima -->
        <div class="col-lg-4">
            <!-- Ringkasan Belanja -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h3 class="h5 mb-0"><i class="fas fa-receipt text-primary me-2"></i>Ringkasan Belanja</h3>
                </div>
                <div class="card-body">
             
                    <div class="d-flex justify-content-between mb-3">
                        <span class="fw-bold">Total:</span>
                        <span class="fw-bold text-primary">Rp {{ number_format($total ?? 0, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Form Data Penerima -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0 py-3">
                    <h3 class="h5 mb-0"><i class="fas fa-user-circle text-primary me-2"></i>Data Penerima</h3>
                </div>
                <div class="card-body">
                    <form id="recipientForm">
                        <div class="mb-3">
                            <label for="recipientName" class="form-label small fw-bold">Nama Penerima</label>
                            <input type="text" class="form-control form-control-sm" id="recipientName" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="recipientAddress" class="form-label small fw-bold">Alamat Lengkap</label>
                            <textarea class="form-control form-control-sm" id="recipientAddress" rows="3" required></textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="recipientPhone" class="form-label small fw-bold">Nomor HP/WhatsApp</label>
                                <input type="tel" class="form-control form-control-sm" id="recipientPhone" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="recipientEmail" class="form-label small fw-bold">Email (Opsional)</label>
                                <input type="email" class="form-control form-control-sm" id="recipientEmail">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="orderNotes" class="form-label small fw-bold">Catatan Pesanan</label>
                            <textarea class="form-control form-control-sm" id="orderNotes" rows="2" placeholder="Contoh: Warna buku, catatan khusus, dll."></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 py-2">
                            <i class="fas fa-credit-card me-2"></i> Lanjut ke Pembayaran
                        </button>
                    </form>
                    
                    <a href="{{ url('/') }}" class="btn btn-outline-secondary w-100 mt-2 py-2">
                        <i class="fas fa-arrow-left me-2"></i> Lanjutkan Belanja
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Styles */
    .cart-item:hover {
        background-color: #f8f9fa;
        transition: background-color 0.2s ease;
    }
    
    .input-group-sm > .btn {
        padding: 0.25rem 0.5rem;
    }
    
    .form-control-sm {
        padding: 0.25rem 0.5rem;
        height: calc(1.5em + 0.5rem + 2px);
    }
    
    @media (max-width: 767.98px) {
        .cart-item {
            padding: 1rem;
        }
        
        .img-fluid {
            max-width: 70px;
        }
        
        .h6 {
            font-size: 0.9rem;
        }
    }
    
    /* Animasi Button */
    .btn-primary {
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>

<script>
    // Quantity Button Functionality
    document.querySelectorAll('.minus-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.nextElementSibling;
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        });
    });
    
    document.querySelectorAll('.plus-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const max = parseInt(input.getAttribute('max'));
                input.value = parseInt(input.value) + 1;
        });
    });
    
    // Form Submission
    document.getElementById('recipientForm').addEventListener('submit', function(e) {
        e.preventDefault();
        // Validasi dan proses checkout bisa ditambahkan disini
        alert('Data penerima berhasil disimpan!');
    });
</script>
@endsection