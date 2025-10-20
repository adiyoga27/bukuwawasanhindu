@extends('layouts.admin')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Produk</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Produk</a></li>
                        <li class="breadcrumb-item active">Tambah Produk</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Produk</h4>
                    <p class="card-title-desc">
                        Silahkan isi data produk pada form di bawah ini. Data yang sudah diisi akan ditampilkan pada tabel
                        di bawahnya.
                    </p>

                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Tgl Dibuat</th>
                                <th>Judul</th>
                                <th>Slug</th>
                                <th>Harga</th>
                                <th>Diskon</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($datas as $item)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y H:i') }} wita</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->slug }}</td>
                                    <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td>Rp{{ number_format($item->discount, 0, ',', '.') }}</td>
                                    <td>
                                        @if ($item->is_active)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-2">
                                            <!-- Gallery -->
                                            <a href="#" class="btn btn-success btn-sm d-flex align-items-center"
                                                data-bs-toggle="modal" data-bs-target="#galleryModal{{ $item->id }}">
                                                <i class="fas fa-images me-1"></i> Gallery
                                            </a>

                                            <!-- Edit -->
                                            <a href="#"
                                                class="btn btn-info btn-sm d-flex align-items-center editProductBtn"
                                                data-id="{{ $item->id }}">
                                                <i class="fas fa-edit me-1"></i> Edit
                                            </a>

                                            <!-- Delete -->
                                            <form action="{{ url('admin/products/' . $item->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-danger btn-sm d-flex align-items-center"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                                    <i class="fas fa-trash-alt me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                 <!-- Gallery list -->
                       
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFormModal">
                            <i class="fas fa-plus"></i> Tambah Kategori
                        </a>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <!-- end row -->

    <div class="modal fade" id="addFormModal" tabindex="-1" aria-labelledby="addFormModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFormModalLabel">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <form action="{{ url('admin/products') }}" method="POST" enctype="multipart/form-data"> --}}
                    <form id="addProductForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Kategori</label>
                            <select class="form-control" name="category_id" required>
                                @foreach ($categories as $c)
                                    <option value={{ $c->id }}>{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Judul Buku</label>
                            <input type="text" class="form-control" name="title" id="title"
                                placeholder="Masukkan judul buku" required>
                        </div>
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Pengarang</label>
                            <input type="text" class="form-control" name="author" id="author"
                                placeholder="Masukkan nama pengarang buku ..." required>
                        </div>
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Bintang</label>
                            <input type="number" min="1" max="5" class="form-control" name="rating"
                                id="rating" placeholder="Masukkan jumlah bintang ..." required>
                            <p>contoh : 0.0 s/d 5.0</p>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="categoryName" class="form-label">Harga</label>
                                    <input type="number" class="form-control" name="price" id="price"
                                        placeholder="Masukkan harga buku ..." required>
                                    <p>Contoh : 100000</p>
                                </div>
                                <div class="col-md-6">
                                    <label for="categoryName" class="form-label">Diskon Harga</label>
                                    <input type="number" class="form-control" name="discount" id="discount"
                                        placeholder="Masukkan harga diskon buku ...">
                                    <p>Contoh : 100000</p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Deskripsi</label>
                            <textarea class="form-control elm1" name="description" required>
                          </textarea>
                        </div>
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Upload Gambar</label>
                            <input type="file" class="form-control" name="thumbnail" id="thumbnail" required>
                        </div>
                        <div class="mb-3">
                            <label for="tokopedia" class="form-label">Link Tokopedia</label>
                            <input type="text" class="form-control" name="tokopedia" id="tokopedia"
                                placeholder="Masukkan tokopedia buku pembelian ..." required>
                        </div>
                        <div class="mb-3">
                            <label for="shopee" class="form-label">Link Shopee</label>
                            <input type="text" class="form-control" name="shopee" id="shopee"
                                placeholder="Masukkan shopee buku pembelian ..." required>
                        </div>
                        <div class="mb-3">
                            <label for="lazada" class="form-label">Link Lazada</label>
                            <input type="text" class="form-control" name="lazada" id="lazada"
                                placeholder="Masukkan lazada buku pembelian ..." required>
                        </div>
                           <div class="mb-3">
                            <label for="lazada" class="form-label">Link Tiktokshop</label>
                            <input type="text" class="form-control" name="tiktokshop" id="tiktokshop"
                                placeholder="Masukkan lazada buku pembelian ..." required>
                        </div>
                        <div class="mb-3">
                            <label for="lazada" class="form-label">Tags</label>
                            <input type="text" class="form-control" name="keyword" id="keyword"
                                placeholder="Masukkan tag keyword ..." required>
                            <p style="color:red"> Contoh: Agama, Yoga,</p>

                        </div>
                        <div class="mb-3">
                            <label for="categoryStatus" class="form-label">Status</label>
                            <select class="form-select" name="is_active" required>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Gallery Modal -->

    <!-- Global Edit Modal -->
    <div class="modal fade" id="editFormModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editProductForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="edit_id">

                        <div class="mb-3">
                            <label>Kategori</label>
                            <select class="form-control" name="category_id" id="edit_category_id" required>
                                @foreach ($categories as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Judul</label>
                            <input type="text" class="form-control" name="title" id="edit_title" required>
                        </div>
                        <div class="mb-3">
                            <label>Pengarang</label>
                            <input type="text" class="form-control" name="author" id="edit_author" required>
                        </div>
                        <div class="mb-3">
                            <label>Bintang</label>
                            <input type="number" step="0.1" min="0" max="5" class="form-control"
                                name="rating" id="edit_rating" required>
                        </div>
                        <div class="mb-3">
                            <label>Harga</label>
                            <input type="number" class="form-control" name="price" id="edit_price" required>
                        </div>
                        <div class="mb-3">
                            <label>Diskon</label>
                            <input type="number" class="form-control" name="discount" id="edit_discount">
                        </div>
                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea class="form-control elm1" name="description" id="edit_description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Thumbnail</label>

                            <div id="edit_thumbnail_preview" class="mb-2"></div>
                            <input type="file" class="form-control" name="thumbnail" id="edit_thumbnail">
                        </div>
                        <div class="mb-3">
                            <label>Tokopedia</label>
                            <input type="text" class="form-control" name="tokopedia" id="edit_tokopedia">
                        </div>
                        <div class="mb-3">
                            <label>Shopee</label>
                            <input type="text" class="form-control" name="shopee" id="edit_shopee">
                        </div>
                        <div class="mb-3">
                            <label>Lazada</label>
                            <input type="text" class="form-control" name="lazada" id="edit_lazada">
                        </div><div class="mb-3">
                            <label>Tiktokshop</label>
                            <input type="text" class="form-control" name="tiktokshop" id="edit_tiktokshop">
                        </div>
                        <div class="mb-3">
                            <label>Tags</label>
                            <input type="text" class="form-control" name="keyword" id="edit_keyword">
                        </div>
                        <div class="mb-3">
                            <label>Status</label>
                            <select class="form-control" name="is_active" id="edit_is_active">
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary" id="editSubmitBtn">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- === Gallery Modals (render di luar tabel!) === --}}
@foreach ($datas as $item)
<div class="modal fade" id="galleryModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Gallery - {{ $item->title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">

                {{-- Form upload --}}
                <form id="galleryUploadForm{{ $item->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $item->id }}">
                    <div class="mb-3">
                        <input type="file" name="images[]" multiple class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>

                {{-- Progress bar --}}
                <div id="uploadProgress{{ $item->id }}" class="progress mt-2 d-none">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width:0%"></div>
                </div>

                {{-- List gambar --}}
                <div class="row mt-3" id="imageList{{ $item->id }}">
                    @if (!empty($item->galleries))
                        @foreach ($item->galleries as $g)
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img src="{{ url('storage/'.$g->image_path) }}" class="card-img-top" alt="Gallery image">
                                    <div class="card-body p-2">
                                        <button class="btn btn-danger btn-sm delete-image"
                                            data-id="{{ $g->id }}" data-product="{{ $item->id }}">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
@section('js')
    <!-- Required datatable js -->
    <script src="{{ url('assets') }}/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('assets') }}/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="{{ url('assets') }}/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ url('assets') }}/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ url('assets') }}/libs/jszip/jszip.min.js"></script>
    <script src="{{ url('assets') }}/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{ url('assets') }}/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="{{ url('assets') }}/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ url('assets') }}/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{ url('assets') }}/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

    <!-- Responsive examples -->
    <script src="{{ url('assets') }}/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ url('assets') }}/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <!-- Datatable init js -->
    <script src="{{ url('assets') }}/js/pages/datatables.init.js"></script>
    <script src="{{ url('assets') }}/libs/tinymce/tinymce.min.js"></script>

    <script>
        if ($(".elm1").length > 0) {
            tinymce.init({
                selector: "textarea.elm1",
                height: 300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
                style_formats: [{
                        title: "Bold text",
                        inline: "b"
                    },
                    {
                        title: "Red text",
                        inline: "span",
                        styles: {
                            color: "#ff0000"
                        }
                    },
                    {
                        title: "Red header",
                        block: "h1",
                        styles: {
                            color: "#ff0000"
                        }
                    },
                    {
                        title: "Example 1",
                        inline: "span",
                        classes: "example1"
                    },
                    {
                        title: "Example 2",
                        inline: "span",
                        classes: "example2"
                    },
                    {
                        title: "Table styles"
                    },
                    {
                        title: "Table row 1",
                        selector: "tr",
                        classes: "tablerow1"
                    }
                ]
            });
        }
        // Pastikan DOM sudah sepenuhnya dimuat
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi TinyMCE hanya jika elemen textarea dengan kelas elm1 ada

            // Gallery Upload Script
            document.querySelectorAll('[id^="galleryUploadForm"]').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const formId = this.id.replace('galleryUploadForm', '');
                    const formData = new FormData(this);
                    const progressBar = document.getElementById('uploadProgress' + formId);
                    const progressBarInner = progressBar.querySelector('.progress-bar');
                    const imageList = document.getElementById('imageList' + formId);

                    progressBar.classList.remove('d-none');

                    fetch(window.location.origin + "/admin/products/gallery", {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            progressBar.classList.add('d-none');
                            if (data.success) {
                                // Clear file input
                                this.querySelector('input[type="file"]').value = '';

                                // Add new images to preview
                                data.images.forEach(image => {
                                    const col = document.createElement('div');
                                    col.className = 'col-md-3 mb-3';
                                    col.innerHTML = `
                            <div class="card">
                                <img src="${image.path}" class="card-img-top" alt="Gallery image">
                                <div class="card-body p-2">
                                    <button class="btn btn-danger btn-sm delete-image" 
                                            data-id="${image.id}" data-product="${data.product_id}">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        `;
                                    imageList.appendChild(col);

                                    // Add delete event to new image
                                    col.querySelector('.delete-image').addEventListener(
                                        'click', deleteGalleryImage);
                                });
                            } else {
                                alert('Error: ' + (data.message || 'Gagal mengupload gambar'));
                            }
                        })
                        .catch(error => {
                            progressBar.classList.add('d-none');
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat mengupload gambar');
                        });
                });
            });

            // Delete gallery image
            function deleteGalleryImage() {
                if (confirm('Apakah Anda yakin ingin menghapus gambar ini?')) {
                    const imageId = this.dataset.id;
                    const productId = this.dataset.product;
                    const button = this;

                    fetch(window.location.origin + "/admin/products/gallery/delete", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                image_id: imageId,
                                product_id: productId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                button.closest('.col-md-3').remove();
                            } else {
                                alert('Error: ' + (data.message || 'Gagal menghapus gambar'));
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat menghapus gambar');
                        });
                }
            }

            // Initialize delete buttons
            document.querySelectorAll('.delete-image').forEach(button => {
                button.addEventListener('click', deleteGalleryImage);
            });
        });

        // AJAX untuk form tambah produk
        $('#addProductForm').on('submit', function(e) {
            e.preventDefault();

            // Ambil konten dari TinyMCE
            if (typeof tinymce !== 'undefined' && tinymce.get('description')) {
                tinymce.get('description').save();
            }

            var formData = new FormData(this);
            var submitButton = $('#submitButton');
            var originalButtonText = submitButton.html();

            // Tampilkan loading state
            submitButton.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');

            $.ajax({
                url: window.location.href,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message || 'Produk berhasil ditambahkan!',
                            timer: 1500,
                            showConfirmButton: false
                        });

                        // Reset form
                        $('#addProductForm')[0].reset();

                        // Tutup modal
                        $('#addFormModal').modal('hide');

                        // Reload halaman setelah 1.5 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: response.message ||
                                'Terjadi kesalahan saat menambahkan produk.'
                        });
                    }
                },
                error: function(xhr) {
                    let errorMessage = 'Terjadi kesalahan saat menyimpan data.';

                    if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                        // Jika ada error validasi Laravel
                        let errors = xhr.responseJSON.errors;
                        errorMessage = '';
                        $.each(errors, function(key, value) {
                            errorMessage += value[0] + '<br>';
                        });

                        Swal.fire({
                            icon: 'error',
                            title: 'Validasi Gagal!',
                            html: errorMessage
                        });
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: xhr.responseJSON.message
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: errorMessage
                        });
                    }
                },
                complete: function() {
                    // Kembalikan state button ke semula
                    submitButton.prop('disabled', false).html(originalButtonText);
                }
            });
        });


        // Fungsi untuk menampilkan alert
        function showAlert(type, message) {
            var alert = $('#ajaxAlert');
            alert.removeClass('d-none alert-success alert-danger')
                .addClass('alert-' + type)
                .html(message);

            // Scroll ke atas untuk melihat alert
            $('html, body').animate({
                scrollTop: alert.offset().top - 100
            }, 500);
        }

        // Reset form ketika modal ditutup
        $('#addFormModal').on('hidden.bs.modal', function() {
            $('#addProductForm')[0].reset();
            $('#ajaxAlert').addClass('d-none');
        });

        // Klik tombol edit
        $(document).on('click', '.editProductBtn', function(e) {
            e.preventDefault();
            let id = $(this).data('id');

            $.ajax({
                url: "/admin/products/" + id + "/edit",
                type: "GET",
                success: function(response) {
                    if (response.success) {
                        let product = response.data;
                        if (product.thumbnail) {
                            $('#edit_thumbnail_preview').html(`
                    <img src="/storage/${product.thumbnail}" 
                        alt="${product.title}" 
                        class="img-fluid rounded" 
                        style="max-width: 200px; border:1px solid #ddd;">
                `);
                        } else {
                            $('#edit_thumbnail_preview').html(
                                `<small class="text-muted">Belum ada thumbnail</small>`);
                        }
                        $('#edit_id').val(product.id);
                        $('#edit_category_id').val(product.category_id);
                        $('#edit_title').val(product.title);
                        $('#edit_author').val(product.author);
                        $('#edit_rating').val(product.rating);
                        $('#edit_price').val(product.price);
                        $('#edit_discount').val(product.discount);
                        $('#edit_tokopedia').val(product.tokopedia);
                        $('#edit_shopee').val(product.shopee);
                        $('#edit_lazada').val(product.lazada);
                        $('#edit_tiktokshop').val(product.tiktokshop);
                        $('#edit_keyword').val(product.keyword);
                        $('#edit_is_active').val(product.is_active);

                        // TinyMCE set content
                        if (tinymce.get('edit_description')) {
                            tinymce.get('edit_description').setContent(product.description || "");
                        }

                        $('#editFormModal').modal('show');
                    } else {
                        Swal.fire("Error", "Data produk tidak ditemukan!", "error");
                    }
                },
                error: function() {
                    Swal.fire("Error", "Gagal mengambil data produk!", "error");
                }
            });
        });

        // Submit edit form via AJAX
        $('#editProductForm').on('submit', function(e) {
            e.preventDefault();
            let id = $('#edit_id').val();

            // simpan isi TinyMCE
            if (tinymce.get('edit_description')) {
                tinymce.get('edit_description').save();
            }

            let formData = new FormData(this);

            $.ajax({
                url: "/admin/products/" + id,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status) {
                        Swal.fire("Berhasil", "Produk berhasil diperbarui!", "success");
                        $('#editFormModal').modal('hide');
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        Swal.fire("Error", response.message || "Gagal update produk!", "error");
                    }
                },
                error: function(xhr) {
                    Swal.fire("Error", "Terjadi kesalahan!", "error");
                }
            });
        });
    </script>
@endsection
