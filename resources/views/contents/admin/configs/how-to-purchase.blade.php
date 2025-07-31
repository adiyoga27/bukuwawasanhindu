@extends('layouts.admin')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Cara Pembelanjaan</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Konfigurasi</a></li>
                        <li class="breadcrumb-item active">Cara Pembelanjaan</li>
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

               
                        <form action="{{ url('admin/configs/how-to-purchase') }}" method="POST">
                        @csrf
                         <div class="mb-3">
                            <textarea class="form-control elm1" name="how_to_purchase" >
                                {{ $configs->how_to_purchase }}
                          </textarea>
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
    
        
    <script src="{{ url('assets') }}/libs/tinymce/tinymce.min.js"></script>
        <script>
            tinymce.init({
    selector: "textarea.elm1",
    height: 1000,
    plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template paste textcolor"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | " +
             "bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",

    images_upload_url: window.location.origin+"/api/upload-image", // endpoint Laravel untuk upload gambar
    automatic_uploads: true,
    file_picker_types: 'image',
    file_picker_callback: function (cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');

        input.onchange = function () {
            var file = this.files[0];

            var reader = new FileReader();
            reader.onload = function () {
                cb(reader.result, {
                    title: file.name
                });
            };
            reader.readAsDataURL(file);
        };

        input.click();
    }
});

        </script>
@endsection