@extends('layouts.admin')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Testimoni</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Kategori</a></li>
                        <li class="breadcrumb-item active">List Testimoni</li>
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

                    <h4 class="card-title">Testimoni</h4>
                    <p class="card-title-desc">
                        Silahkan isi data Testimoni pada form di bawah ini. Data yang sudah diisi akan ditampilkan pada tabel di bawahnya.
                    </p>

                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Posisi</th>
                                <th>Message</th>
                                <th>Aksi</th>
                              
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($datas as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->role }}</td>
                                <td>{{ $item->message }}</td>
                              
                                <td>
                                    <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editFormModal{{ $item->id }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <!-- Edit Form Modal -->
                                    <div class="modal fade" id="editFormModal{{ $item->id }}" tabindex="-1" aria-labelledby="editFormModalLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editFormModalLabel{{ $item->id }}">Edit Testimoni</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ url('admin/testimonies/'.$item->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        
                                                        
                                                        <div class="mb-3">
                                                            <label for="categoryName" class="form-label">Nama </label>
                                                            <input type="text" class="form-control" name="name" id="categoryName" value="{{ $item->name }}" placeholder="Masukkan nama testimoni">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="categoryName" class="form-label">Posisi </label>
                                                            <input type="text" class="form-control" name="role" id="categoryName" value="{{ $item->role }}" placeholder="Masukkan posisi yang testimoni">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="categoryName" class="form-label">Message </label>
                                                            <textarea type="text" class="form-control" name="message" id="message" >{{ $item->message }}</textarea>
                                                        </div>
                                                           <div class="mb-3">
                            <label for="categoryName" class="form-label">Rating </label>
                            <input type="text" class="form-control" name="rating" id="rating" placeholder="Masukkan jumlah bintang (1-5)" value="{{ $item->rating }}" min="1" max="5">
                            <p class="text-muted">Masukkan angka antara 1 hingga 5.</p>
                        </div>
                        <div>
                            <img src="{{ asset('storage/'.$item->photo) }}" alt="Photo" style="max-width: 200px; max-height: 200px;">
                        </div>
                                                        <div class="mb-3">
                                                            <label for="categoryName" class="form-label">Photo Profile </label>
                                                            <input type="file" class="form-control" name="photo" id="photo" >
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>   
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Edit Form Modal -->


                                  
                                    <form action="{{ url('admin/testimonies/'.$item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus testimoni ini?');">
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
                            <i class="fas fa-plus"></i> Tambah Testimoni
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
                    <h5 class="modal-title" id="addFormModalLabel">Tambah Testimoni</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('admin/testimonies') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Nama </label>
                            <input type="text" class="form-control" name="name" id="categoryName" placeholder="Masukkan nama testimoni">
                        </div>
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Posisi </label>
                            <input type="text" class="form-control" name="role" id="categoryName" placeholder="Masukkan posisi yang testimoni">
                        </div>
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Message </label>
                            <textarea type="text" class="form-control" name="message" id="message" > </textarea>
                        </div>
                         <div class="mb-3">
                            <label for="categoryName" class="form-label">Rating </label>
                            <input type="text" class="form-control" name="rating" id="rating" placeholder="Masukkan jumlah bintang (1-5)"  min="1" max="5">
                            <p class="text-muted">Masukkan angka antara 1 hingga 5.</p>
                        </div>
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Photo Profile </label>
                            <input type="file" class="form-control" name="photo" id="photo" >
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