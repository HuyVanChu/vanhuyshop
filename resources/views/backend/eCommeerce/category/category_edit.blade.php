@extends('backend.master.master')
@section('title')
    Sửa danh mục {{ $category->name }}
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
                            <li class="breadcrumb-item active" aria-current="page">Sửa danh mục {{ $category->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card">
                <div class="card-body p-4">
                    <div class="form-body mt-4">
                        {!!alert_warning(session('thong-bao-loi'))!!}
                        <form action="{{ route('admin_cat_editpost', ['id' => $category->id]) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-8">
                                    <form action="" method="post"></form>
                                    {!!alert_warning(session('thong-bao'))!!}
                                    <div class="border border-3 p-4 rounded">
                                        <div class="mb-3">
                                            <label for="">List cấu trúc danh mục:</label>
                                            <select class="form-control">
                                                @if ($parent == 0)
                                                <option value="{{$id_CategoryChild2}}" selected>{{$cat_name}}</option>
                                                @else
                                                {!! get_categories($categories, 0, '', $cat_id) !!}
                                                @endif
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputProductTitle" class="form-label">Tên danh mục</label>
                                            <input type="text" name="name" class="form-control"
                                                id="inputProductTitle" placeholder="Bắt buộc" value="{{ $category->name }}">
                                        </div>
                                        {!! show_errors_request($errors, 'name') !!}
                                        <div class="mb-3">
                                            <label for="inputProductTitle" class="form-label">Title danh mục</label>
                                            <input type="text" name="title" class="form-control"
                                                id="inputProductTitle" placeholder="Không bắt buộc"
                                                value="{{ $category->title }}">
                                        </div>
                                        @if ($parent!=0)
                                        <div class="mb-3">
                                            <label for="inputProductType" class="form-label">Cấp danh mục</label>
                                            <select class="form-select" id="inputProductType" name="level">
                                                @if (old('cat_level') == null)
                                                    <option value="1" @if ($category->cate_smail == '1') selected @endif>Con</option>
                                                    <option value="0" @if ($category->cate_smail == '0') selected @endif>Cha</option>
                                                @else
                                                    <option value="1" @if (old('cat_level') == '1') selected @endif>Con</option>
                                                    <option value="0" @if (old('cat_level') == '0') selected @endif>Cha</option>
                                                @endif
                                            </select>
                                        </div>  @endif
                                        {{-- @foreach ($categories as $item)
                                        @if ($item->parent!=$category->id)
                                        <div class="mb-3">
                                            <label for="inputProductType" class="form-label">Cấp danh mục</label>
                                            <select class="form-select" id="inputProductType" name="level">
                                                @if (old('cat_level') == null)
                                                    <option value="1" @if ($category->cate_smail == '1') selected @endif>Con</option>
                                                    <option value="0" @if ($category->cate_smail == '0') selected @endif>Cha</option>
                                                @else
                                                    <option value="1" @if (old('cat_level') == '1') selected @endif>Con</option>
                                                    <option value="0" @if (old('cat_level') == '0') selected @endif>Cha</option>
                                                @endif
                                            </select>
                                        </div>
                                        @endif
                                        @endforeach --}}

                                        <div class="mb-3">
                                            <label for="inputProductType" class="form-label">Ảnh danh mục</label>
                                            <input id="img" type="file" name="image" class="form-control hidden"
                                                onchange="changeImg(this)">
                                            <img id="avatar" name="" class="thumbnail" width="100%" height="350px"
                                                src="../category/{{ $category->image }}">
                                        </div>
                                        {!! show_errors_request($errors, 'image') !!}
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="row g-3">
                                            @if ($category->cate_smail == '1')
                                                <div class="col-12">
                                                    <nav>
                                                        <label>Các thuộc Tính <a
                                                                href="{{ route('admin_attr_listattr', ['slug' => $category->slug]) }}"><img
                                                                    src="assets/icon/settings.png" alt="các thuộc tính"
                                                                    width="18px">
                                                                Tuỳ chọn</a></label>
                                                        <div style="background: #1a7208" class="nav nav-tabs" id="nav-tab"
                                                            role="tablist">
                                                            @foreach ($properties as $item)
                                                                <a class="nav-item nav-link active" id="nav-home-tab"
                                                                    data-toggle="tab" href="#tab17" role="tab"
                                                                    aria-controls="nav-home"
                                                                    aria-selected="true">{{ $item->column }}</a>
                                                            @endforeach
                                                            <a class="nav-item nav-link" id="nav-contact-tab"
                                                                data-toggle="tab" href="#add" role="tab"
                                                                aria-controls="nav-contact" aria-selected="false">+</a>
                                                        </div>
                                                    </nav>
                                                    <div class="tab-content" id="nav-tabContent">
                                                        <form action="{{ route('admin_attr_addttrpost') }}" method="post">
                                                            @csrf
                                                            <div class="tab-pane fade show" id="add">
                                                                <div class="form-group">
                                                                    <label for="">Tên thuộc tính mới</label>
                                                                    <input type="text" class="form-control"
                                                                        name="nameattr" aria-describedby="helpId"
                                                                        placeholder="">
                                                                    <input type="hidden" name="cat_id"
                                                                        value="{{ $category->id }}">
                                                                </div>
                                                                {!! show_errors_request($errors, 'nameattr') !!}
                                                                <button type="submit" class="btn btn-success"> <span
                                                                        class="glyphicon glyphicon-plus"></span>
                                                                    Thêm thuộc tính</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="col-12">
                                                <div class="d-grid">
                                                    @if ($parent==0)
                                                    <input type="hidden" name="cate_smail" value="{{ $cate_smail }}">
                                                    @endif
                                                    <input type="hidden" name="category_id" value="{{ $category->id }}">
                                                    <button type="submit" class="btn btn-light">Lưu danh mục</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </form>
                        <!--end row-->
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
