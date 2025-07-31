@extends('layouts.admin')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Website</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Konfigurasi</a></li>
                        <li class="breadcrumb-item active">Website</li>
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

                    <h4 class="card-title">Konfigurasi Website</h4>
                    <p class="card-title-desc">
                        Silahkan isi data konfigurasi website untuk mempercantik website anda
                    </p>
 <form action="{{ url('admin/configs') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Nama Website</label>
                            <input type="text" class="form-control" name="name" placeholder="Masukkan nama website" value="{{ $config?->app_name }}">
                        </div>
                          <div class="mb-3">
                            <label for="address" class="form-label">Alamat Kantor</label>
                            <input type="text" class="form-control" name="address" placeholder="Masukkan address website" value="{{ $config?->address }}">
                        </div>
                   <div class="mb-3">
                            <label for="phone" class="form-label">Telp</label>
                            <input type="text" class="form-control" name="phone" placeholder="Masukkan phone website" value="{{ $config?->phone }}">
                        </div>
                          <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" placeholder="Masukkan email website" value="{{ $config?->email }}">
                        </div>
                           <div class="mb-3">
                            <label for="youtube" class="form-label">Youtube</label>
                            <input type="text" class="form-control" name="youtube" placeholder="Masukkan youtube website" value="{{ $config?->youtube }}">
                        </div>
                        <div class="mb-3">
                            <label for="facebook" class="form-label">Facebook</label>
                            <input type="text" class="form-control" name="facebook" placeholder="Masukkan facebook website" value="{{ $config?->facebook }}">
                        </div>
                           <div class="mb-3">
                            <label for="instagram" class="form-label">Instagram</label>
                            <input type="text" class="form-control" name="instagram" placeholder="Masukkan instagram website" value="{{ $config?->instagram }}">
                        </div>
                        <div class="mb-3">
                            <label for="tiktok" class="form-label">Tiktok</label>
                            <input type="text" class="form-control" name="tiktok" placeholder="Masukkan tiktok website" value="{{ $config?->tiktok }}">
                        </div>
                           <div class="mb-3">
                            <label for="shopee" class="form-label">Shopee Market Place</label>
                            <input type="text" class="form-control" name="shopee" placeholder="Masukkan shopee website" value="{{ $config?->shopee }}">
                        </div>
                           <div class="mb-3">
                            <label for="tokopedia" class="form-label">Tokopedia Market Place</label>
                            <input type="text" class="form-control" name="tokopedia" placeholder="Masukkan tokopedia website" value="{{ $config?->tokopedia }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>   
                    </form>
                 
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <!-- end row -->

 
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