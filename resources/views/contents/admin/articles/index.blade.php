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
                        Silahkan isi data artikel pada form di bawah ini. Data yang sudah diisi akan ditampilkan pada tabel di bawahnya.
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
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->slug }}</td>
                                <td>
                                    @if ($item->is_active)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editFormModal{{ $item->id }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <!-- Edit Form Modal -->
                                    <div class="modal fade" id="editFormModal{{ $item->id }}" tabindex="-1" aria-labelledby="editFormModalLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editFormModalLabel{{ $item->id }}">Edit Kategori</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ url('admin/category-article/'.$item->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="categoryName{{ $item->id }}" class="form-label">Nama Kategori</label>
                                                            <input type="text" class="form-control" name="name" id="categoryName{{ $item->id }}" value="{{ $item->name }}" placeholder="Masukkan nama kategori">
                                                        </div>
                                                        
                                                        <div class="mb-3">
                                                            <label for="categoryStatus{{ $item->id }}" class="form-label">Status Kategori</label>
                                                            <select class="form-select" name="is_active" id="categoryStatus{{ $item->id }}">
                                                                <option value="1" {{ $item->is_active ? 'selected' : '' }}>Aktif</option>   
                                                                <option value="0" {{ !$item->is_active ? 'selected' : '' }}>Tidak Aktif</option>
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>   
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Edit Form Modal -->


                                  
                                    <form action="{{ url('admin/category-article/'.$item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
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

    <!-- Add Form Modal -->
    <div class="modal fade" id="addFormModal" tabindex="-1" aria-labelledby="addFormModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFormModalLabel">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('admin/category-article') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" name="name" id="categoryName" placeholder="Masukkan nama kategori">
                        </div>
                  
                        <div class="mb-3">
                            <label for="categoryStatus" class="form-label">Status Kategori</label>
                            <select class="form-select" name="is_active" id="categoryStatus">
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
        <script src="{{url('assets')}}/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="{{url('assets')}}/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="{{url('assets')}}/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="{{url('assets')}}/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="{{url('assets')}}/libs/jszip/jszip.min.js"></script>
        <script src="{{url('assets')}}/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="{{url('assets')}}/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="{{url('assets')}}/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="{{url('assets')}}/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="{{url('assets')}}/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
        
        <!-- Responsive examples -->
        <script src="{{url('assets')}}/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="{{url('assets')}}/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!-- Datatable init js -->
        <script src="{{url('assets')}}/js/pages/datatables.init.js"></script>    
        
@endsection