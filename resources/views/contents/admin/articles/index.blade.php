@extends('layouts.admin')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Artikel</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Artikel</a></li>
                        <li class="breadcrumb-item active">List Artikel</li>
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

                    <h4 class="card-title">Artikel</h4>
                    <p class="card-title-desc">
                        Silahkan isi data artikel pada form di bawah ini. Data yang sudah diisi akan ditampilkan pada tabel
                        di bawahnya.
                    </p>

                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($datas as $item)
                                <tr>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->slug }}</td>
                                    <td>
                                        @if ($item->is_published)
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
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editFormModalLabel{{ $item->id }}">
                                                            Edit Artikel</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ url('admin/articles/' . $item->id) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
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
                                                                <label for="title" class="form-label">Judul</label>
                                                                <input type="text" class="form-control" name="title"
                                                                    id="title" value="{{ $item->title }}"
                                                                    placeholder="Masukkan nama kategori">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="content" class="form-label">Isi Artikel</label>
                                                                <textarea class="form-control elm1" name="content" required>{{ $item->content }}</textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="meta_keywords" class="form-label">Tags</label>
                                                                <input type="text" class="form-control" name="meta_keywords"
                                                                    id="tags" value="{{ $item->meta_keywords }}"
                                                                    placeholder="Masukkan nama keyword / tags">
                                                                <p>Contoh: buku, alam semesta, tips trik</p>
                                                            </div>
                                                            <div class="mb-3">
                                                                <img src="{{ url('storage/') }}/{{ $item->featured_image }}" width="100px">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="featured_image" class="form-label">Upload
                                                                    Thumbnail</label>
                                                                <input type="file" class="form-control" name="featured_image"
                                                                    id="featured_image" >
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="categoryStatus{{ $item->id }}"
                                                                    class="form-label">Status Kategori</label>
                                                                <select class="form-select" name="is_active"
                                                                    id="categoryStatus{{ $item->id }}">
                                                                    <option value="1"
                                                                        {{ $item->is_published ? 'selected' : '' }}>Aktif
                                                                    </option>
                                                                    <option value="0"
                                                                        {{ !$item->is_published ? 'selected' : '' }}>Tidak
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



                                        <form action="{{ url('admin/articles/' . $item->id) }}" method="POST"
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
                            <i class="fas fa-plus"></i> Tambah Artikel
                        </a>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <!-- end row -->

    <!-- Add Form Modal -->
    <div class="modal fade" id="addFormModal" tabindex="-1" aria-labelledby="addFormModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFormModalLabel">Tambah Artikel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('admin/articles') }}" method="POST" enctype="multipart/form-data">
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
                            <label for="title" class="form-label">Judul</label>
                            <input type="text" class="form-control" name="title" id="title"
                                placeholder="Masukkan nama kategori">
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Isi Artikel</label>
                            <textarea class="form-control elm1" name="content" required> </textarea>
                        </div>
                        <div class="mb-3">
                            <label for="meta_keywords" class="form-label">Tags</label>
                            <input type="text" class="form-control" name="meta_keywords" id="meta_keywords"
                                placeholder="Masukkan nama keyword / tags">
                            <p>Contoh: buku, alam semesta, tips trik</p>
                        </div>
                        <div class="mb-3">
                            <label for="thumbnail" class="form-label">Upload Thumbnail</label>
                            <input type="file" class="form-control" name="featured_image" id="featured_image" required>
                        </div>
                        <div class="mb-3">
                            <label for="is_published" class="form-label">Status Artikel</label>
                            <select class="form-select" name="is_published" id="is_published">
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
    </script>
@endsection
