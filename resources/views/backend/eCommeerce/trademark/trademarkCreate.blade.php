@extends('backend.master.master')
@section('title')
    Thêm thương hiệu
@endsection
@section('main')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Thêm thương hiệu</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card">
                <div class="card-body p-4">
                    <div class="form-body mt-4">
                        <form action="{{ route('admin_trademark_createPost') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="mb-3">
                                            <label for="inputProductTitle" class="form-label">Tên thương hiệu</label>
                                            <input type="text" name="name" class="form-control" id="inputProductTitle"
                                                placeholder="Bắt buộc" value="{{old('name')}}">
                                        </div>
                                        {!! show_errors_request($errors, 'name') !!}
                                        <div class="mb-3">
                                            <label for="inputProductTitle" class="form-label">Title thương hiệu</label>
                                            <input type="text" name="title" class="form-control" id="inputProductTitle"
                                                placeholder="Không bắt buộc" value="{{old('title')}}">
                                        </div>
                                        {!! show_errors_request($errors, 'title') !!}
                                        <div class="mb-3">
                                            <label for="inputProductDescription" class="form-label">Ảnh thương hiệu</label>
                                            <input id="img" type="file" name="image" class="form-control hidden"
                                                onchange="changeImg(this)">
                                            <img id="avatar" name="" class="thumbnail" width="100%" height="350px"
                                                src="../trademark/import-img.png">
                                        </div>
                                        {!! show_errors_request($errors, 'image') !!}
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-light">Lưu thương
                                                        hiệu</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@section('script')
    @parent
    <script>
        function changeImg(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#avatar').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(document).ready(function() {
            $('#avatar').click(function() {
                $('#img').click();
            });
        });

    </script>
@stop
@endsection
