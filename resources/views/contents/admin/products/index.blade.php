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
                                        <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editFormModal{{ $item->id }}">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <!-- Edit Form Modal -->
                                        <div class="modal fade" id="editFormModal{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="editFormModalLabel{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editFormModalLabel{{ $item->id }}">
                                                            Edit </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ url('admin/products/' . $item->id) }}" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for="categoryName"
                                                                    class="form-label">Kategori</label>
                                                                <select class="form-control" name="category_id" required>
                                                                    @foreach ($categories as $c)
                                                                        <option value={{ $c->id }}
                                                                            @if ($c->id == $item->category_id) selected @endif>
                                                                            {{ $c->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="categoryName" class="form-label">Judul
                                                                    Buku</label>
                                                                <input type="text" class="form-control" name="title"
                                                                    id="title" placeholder="Masukkan judul buku"
                                                                    value="{{ $item->title }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="categoryName"
                                                                    class="form-label">Pengarang</label>
                                                                <input type="text" class="form-control" name="author"
                                                                    id="author"
                                                                    placeholder="Masukkan nama pengarang buku ..."
                                                                    value="{{ $item->author }}" required>
                                                            </div>
                                                        <div class="mb-3">
                                                                                    <label for="categoryName" class="form-label">Bintang</label>
                                                                                    <input class="form-control" name="rating" id="rating" value="{{ $item->rating }}" 
                                                                                        placeholder="Masukkan jumlah bintang ..." required>
                                                                                        <p>contoh : 0.0 s/d 5.0</p>
                                                                                </div>
                                                            <div class="mb-3">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="categoryName"
                                                                            class="form-label">Harga</label>
                                                                        <input type="number" class="form-control"
                                                                            name="price" id="price"
                                                                            placeholder="Masukkan harga buku ..."
                                                                            value="{{ $item->price }}" required>
                                                                            <p>Contoh : 100000</p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="categoryName" class="form-label">Diskon
                                                                            Harga</label>
                                                                        <input type="number" class="form-control"
                                                                            name="discount" id="discount"
                                                                            placeholder="Masukkan harga diskon buku ..."
                                                                            value="{{ $item->discount }}">
                                                                            <p>Contoh : 100000</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="categoryName"
                                                                    class="form-label">Deskripsi</label>
                                                                <textarea class="form-control elm1" name="description" required> {{ $item->description }} </textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="categoryName" class="form-label">Upload
                                                                    Gambar</label>
                                                                <input type="file" class="form-control" name="thumbnail"
                                                                    id="thumbnail">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="categoryStatus{{ $item->id }}"
                                                                    class="form-label">Status Kategori</label>
                                                                <select class="form-select" name="is_active"
                                                                    id="categoryStatus{{ $item->id }}">
                                                                    <option value="1"
                                                                        {{ $item->is_active ? 'selected' : '' }}>Aktif
                                                                    </option>
                                                                    <option value="0"
                                                                        {{ !$item->is_active ? 'selected' : '' }}>Tidak
                                                                        Aktif</option>
                                                                </select>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Edit Form Modal -->



                                        <form action="{{ url('admin/categories/' . $item->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
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
                    <form action="{{ url('admin/products') }}" method="POST" enctype="multipart/form-data">
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
                            <input type="number" min="1" max="5" class="form-control" name="rating" id="rating"
                                placeholder="Masukkan jumlah bintang ..." required>
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
                            <textarea class="form-control elm1"  name="description" required>
                          </textarea>
                        </div>
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Upload Gambar</label>
                            <input type="file" class="form-control" name="thumbnail" id="thumbnail" required>
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
       <!--tinymce js-->
        <script src="{{ url('assets') }}/libs/tinymce/tinymce.min.js"></script>

        <!-- init js -->
        {{-- <script src="{{ url('assets') }}/js/pages/form-editor.init.js"></script> --}}

    <!-- Datatable init js -->
    <script src="{{ url('assets') }}/js/pages/datatables.init.js"></script>

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
      style_formats: [
        { title: "Bold text", inline: "b" },
        { title: "Red text", inline: "span", styles: { color: "#ff0000" } },
        { title: "Red header", block: "h1", styles: { color: "#ff0000" } },
        { title: "Example 1", inline: "span", classes: "example1" },
        { title: "Example 2", inline: "span", classes: "example2" },
        { title: "Table styles" },
        { title: "Table row 1", selector: "tr", classes: "tablerow1" }
      ]
    });
  }
        </script>
@endsection
