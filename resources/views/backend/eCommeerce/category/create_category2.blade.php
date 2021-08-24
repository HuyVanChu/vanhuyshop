@extends('backend.master.master')
@section('title')
    Thêm danh mục h
@endsection
@section('main')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.index')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Thêm danh mục</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card">
                <div class="card-body p-4">
                    <div class="form-body mt-4">
                        <form action="{{ route('admin_cat_createpost2') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <form action="" method="post"></form>
                                <div class="col-lg-8">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="mb-3">
                                            <label for="inputProductTitle" class="form-label">Tên danh mục</label>
                                            <input type="text" name="name_category" class="form-control"
                                                id="inputProductTitle" placeholder="Bắt buộc"
                                                value="{{ old('name_category') }}">
                                        </div>
                                        {!! show_errors_request($errors, 'name_category') !!}
                                        <div class="mb-3">
                                            <label for="inputProductTitle" class="form-label">Title danh mục</label>
                                            <input type="text" name="title_category" class="form-control"
                                                id="inputProductTitle" placeholder="Không bắt buộc"
                                                value="{{ old('title_category') }}">
                                        </div>
                                        {!! show_errors_request($errors, 'title_category') !!}

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="row g-3">

                                            <div class="col-12">
                                                <label for="inputProductDescription" class="form-label">Ảnh danh mục</label>
                                                <input id="img" type="file" name="image_category"
                                                    class="form-control hidden" onchange="changeImg(this)">
                                                <img id="avatar" name="" class="thumbnail" width="100%" height="350px"
                                                    src="../category/import-img.png">
                                            </div>
                                            {!! show_errors_request($errors, 'image_category') !!}

                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <input type="hidden" name="parent" value="0">
                                                    <input type="hidden" name="Create_url_slug" value="{{$Create_url_slug}}">

                                                    <button type="submit" class="btn btn-light">Lưu danh mục</button>
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
