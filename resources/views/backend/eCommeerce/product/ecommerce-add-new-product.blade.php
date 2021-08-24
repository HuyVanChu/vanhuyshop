
@extends('backend.master.master')
@section('title')
    Thêm sản phẩm
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
                            <li class="breadcrumb-item active" aria-current="page">Thêm sản phẩm mới</li>
                        </ol>
                    </nav>
                </div>
            </div>
            {!!alert_warning(session('thong-bao-loi'))!!}
            @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="card">
                <div class="card-body p-4">
                    <div class="form-body mt-4">
                        <form action="{{ route('admin_prd_createpost') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <form action="" method="post"></form>
                                <div class="col-lg-8">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="mb-3">
                                            <label for="inputVendor" class="form-label">Thương hiệu</label>
                                            <select class="form-select" id="inputVendor" name="trademark_id">
                                                <option value="">--Chọn--</option>
                                                @foreach ($trademarks as $trademark)
                                                    <option value="{{ $trademark->id }}">{{ $trademark->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        {!! show_errors_request($errors, 'trademark_id') !!}
                                        <div class="mb-3">
                                            <label for="inputProductTitle" class="form-label">Tên sản phẩm</label>
                                            <input type="text" name="name" class="form-control" id="inputProductTitle"
                                                placeholder="Bắt buộc" value="{{ old('name') }}">
                                        </div>
                                        {!! show_errors_request($errors, 'name') !!}
                                        <div class="mb-3">
                                            <label for="inputProductTitle" class="form-label">Title</label>
                                            <input type="text" name="title" class="form-control" id="inputProductTitle"
                                                placeholder="Không bắt buộc" value="{{ old('title') }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="inputProductTitle" class="form-label">Giá</label>
                                            <input type="number" name="price" class="form-control" id="inputProductTitle"
                                                placeholder="Bắt buộc" value="{{ old('price') }}">
                                        </div>
                                        {!! show_errors_request($errors, 'price') !!}
                                        <div class="mb-3">
                                            <label for="inputProductTitle" class="form-label">Mã Code</label>
                                            <input type="text" name="product_code" class="form-control"
                                                id="inputProductTitle" placeholder="Bắt buộc"
                                                value="{{ old('product_code') }}">
                                        </div>
                                        {!! show_errors_request($errors, 'product_code') !!}

                                        <div class="mb-3">
                                            <label for="inputProductType" class="form-label">Nổi bật</label>
                                            <select class="form-select" id="inputProductType" name="featured">
                                                <option value="">--Chọn--</option>
                                                <option value="1">Nổi bật</option>
                                                <option value="2">Không</option>
                                            </select>
                                        </div>
                                        @foreach ($column as $item_column)
                                            <div class="mb-3">
                                                <label for="inputCompareatprice"
                                                    class="form-label">{{ $item_column->column }}</label>
                                                <input type="hidden" value="{{$item_column->id}}" name="propertie_id[]">
                                                <input type="text" class="form-control" id="inputCompareatprice"
                                                    placeholder="Không bắt buộc" name="{{ $item_column->id }}">
                                            </div>
                                        @endforeach
                                        <div class="mb-3">
                                            <label for="inputProductDescription" class="form-label">Giới thiệu</label>
                                            <textarea class="form-control ckeditor" id="description" rows="3"
                                                name="info">{{ old('info') }}</textarea>
                                        </div>
                                        {!! show_errors_request($errors, 'info') !!}
                                        <div class="mb-3">
                                            <label for="inputProductDescription" class="form-label">Description</label>
                                            <textarea class="form-control ckeditor" id="description" rows="3"
                                                name="description">{{ old('description') }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputProductDescription" class="form-label">Ảnh 1</label>
                                            <input id="img" type="file" name="image" class="form-control hidden"
                                                onchange="changeImg(this)">
                                            <img id="avatar" name="image" class="thumbnail" width="100%" height="350px"
                                                src="../product/import-img.png">
                                        </div>
                                        {!! show_errors_request($errors, 'image') !!}
                                        <div class="mb-3">
                                            <label for="inputProductDescription" class="form-label">Ảnh 2</label>
                                            <input id="img2" type="file" name="image2" class="form-control hidden"
                                                onchange="changeImg2(this)">
                                            <img id="avatar2" name="image2" class="thumbnail" width="100%" height="350px"
                                                src="../product/import-img.png">
                                        </div>
                                        {!! show_errors_request($errors, 'image2') !!}
                                        <div class="mb-3">
                                            <label for="inputProductDescription" class="form-label">Nhiều ảnh hơn</label>
                                        </div>
                                        <div class="mb-3">
                                            <input id="image-uploadify" type="file" name="images[]" multiple>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                {!! alert_success(session('thong-bao-add-attribute-success')) !!}
                                                {!! show_errors_request($errors, 'attr_name') !!}
                                                <nav>
                                                    <label>Các thuộc Tính <a
                                                            href="{{ route('admin_prd_listattr', ['cat_name' => $cat_name, 'cat_id' => $cat_id]) }}"><img
                                                                src="assets/icon/settings.png" alt="các thuộc tính"
                                                                width="18px">
                                                            Tuỳ chọn</a></label>
                                                    <div style="background: #1a7208" class="nav nav-tabs" id="nav-tab"
                                                        role="tablist">
                                                        @php
                                                            $i = 0;
                                                        @endphp
                                                        @foreach ($category->CategoriesAttribute as $attr_item)
                                                            <a class="nav-item nav-link @if ($i==0) active @endif" id="nav-home-tab" data-toggle="tab" href="#tab{{ $attr_item->id }}" role="tab" aria-controls="nav-home" aria-selected="true">{{ $attr_item->name }}</a>
                                                            @php
                                                                $i = 1;
                                                            @endphp
                                                        @endforeach
                                                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#add" role="tab" aria-controls="nav-contact" aria-selected="false">+</a>
                                                    </div>
                                                </nav>
                                                <div class="tab-content" id="nav-tabContent">
                                                    @foreach ($category->CategoriesAttribute as $attr_item_2)
                                                        <div class="tab-pane fade show @if($i==0) active @endif" id="tab{{ $attr_item_2->id }}">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        @foreach ($attr_item_2->values as $item_value)
                                                                            <th>{{ $item_value->value }}</th>
                                                                        @endforeach
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        @foreach ($attr_item_2->values as $item_value_checkbox)
                                                                            <td><input class="form-check-input"
                                                                                    type="checkbox"
                                                                                    name="attr[{{ $attr_item_2->id }}][]"
                                                                                    value="{{ $item_value_checkbox->id }}">
                                                                            </td>
                                                                        @endforeach
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <hr>
                                                            <form action="{{ route('admin_prd_valuepost') }}"
                                                                method="post">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="">Thêm giá trị của thuộc tính</label>
                                                                    <input type="hidden" name="id_attr"
                                                                        value="{{ $attr_item_2->id }}">
                                                                    <input name="var_name" type="text" class="form-control"
                                                                        aria-describedby="helpId" placeholder="Bắt buộc">
                                                                    {!! show_errors_request($errors, 'var_name') !!}
                                                                    <div>
                                                                        <button class="btn btn-success"
                                                                            type="submit">Thêm</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        @php
                                                            $i = 2;
                                                        @endphp
                                                    @endforeach
                                                    <div class="tab-pane fade show" id="add">
                                                        <form action="{{ route('admin_prd_attrpost') }}" method="post">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="">Tên thuộc tính mới</label>
                                                                <input type="hidden" name="id_cat"
                                                                    value="{{ $cat_id }}">
                                                                <input type="text" class="form-control" name="attr_name"
                                                                    aria-describedby="helpId" placeholder="">
                                                            </div>

                                                            <button type="submit" name="add_pro" class="btn btn-success">
                                                                <span class="glyphicon glyphicon-plus"></span>
                                                                Thêm thuộc tính</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <input type="hidden" value="{{$cat_id}}" name="cat_id">
                                                    <button type="submit" class="btn btn-light">Save Product</button>
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
    <script>
        function changeImg2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#avatar2').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(document).ready(function() {
            $('#avatar2').click(function() {
                $('#img2').click();
            });
        });

    </script>

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('ckfinder/ckfinder.js') }}"></script>
    @endsection
@endsection
