@extends('backend.master.master')
@section('title')
    Thêm danh mục
@endsection
@section('main')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">

            <!--breadcrumb-->
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
            <!--end breadcrumb-->

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
                                        @if (!isset($Create_slug_cat))
                                        <div class="mb-3">
                                            <label for="inputVendor" class="form-label">Cấp thư mục</label>
                                            <select class="form-select" id="inputVendor" name="level_cat">
                                                <option value=""></option>
                                                <option value="0" @if (old('level_cat') == 0) selected @endif>Cha</option>
                                                @if (isset($slug_cat))
                                                <option value="1" @if (old('level_cat') == 1) selected @endif>Con</option>
                                                @endif
                                            </select>
                                        </div>
                                        {!! show_errors_request($errors, 'level_cat') !!}
                                        @endif
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
                                                    <input type="hidden" name="id" value="{{$id}}">
                                                    <input type="hidden" name="check_choose" value="{{$check_choose}}">

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
