@extends('backend.master.master')
@section('title')
    Thêm quản trị Website
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
                            <li class="breadcrumb-item active" aria-current="page">Thêm quản trị</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card">
                <div class="card-body p-4">
                    <div class="form-body mt-4">
                        <div class="row">
                            <form action="{{route('admin_user_addpost')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-12">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="mb-3">
                                            <label for="inputVendor" class="form-label">Tên</label>
                                            <input type="text" name="name" class="form-control" id="inputProductTitle"
                                                placeholder="Bắt buộc" value="{{old('name')}}">
                                        </div>
                                        {!! show_errors_request($errors, 'name') !!}
                                        <div class="mb-3">
                                            <label for="inputVendor" class="form-label">Điện thoại</label>
                                            <input type="text" name="phone" class="form-control" id="inputProductTitle"
                                                placeholder="Bắt buộc" value="{{old('phone')}}">
                                        </div>
                                        {!! show_errors_request($errors, 'phone') !!}
                                        <div class="mb-3">
                                            <label for="inputVendor" class="form-label">Địa chỉ</label>
                                            <input type="text" name="address" class="form-control" id="inputProductTitle"
                                                placeholder="Bắt buộc" value="{{old('address')}}">
                                        </div>
                                        {!! show_errors_request($errors, 'address') !!}
                                        <div class="mb-3">
                                            <label for="inputVendor" class="form-label">Ngày sinh</label>
                                            <input type="date" name="datetime" class="form-control" id="inputProductTitle"
                                                placeholder="Bắt buộc">
                                        </div>
                                        {!! show_errors_request($errors, 'datetimeư') !!}
                                        <div class="mb-3">
                                            <label for="inputProductTitle" class="form-label">Email</label>
                                            <input type="text" name="email" class="form-control" id="inputProductTitle"
                                                placeholder="Bắt buộc" value="{{old('email')}}">
                                        </div>
                                        {!! show_errors_request($errors, 'email') !!}
                                        <div class="mb-3">
                                            <label for="inputProductTitle" class="form-label">Mật khẩu</label>
                                            <input type="password" name="password" class="form-control" id="inputProductTitle"
                                                placeholder="Bắt buộc" value="{{old('password')}}">
                                        </div>
                                        {!! show_errors_request($errors, 'password') !!}
                                        <div class="mb-3">
                                            <label for="inputProductDescription" class="form-label">Ảnh</label>
                                            <input id="img" type="file" name="image" class="form-control hidden"
                                                onchange="changeImg(this)">
                                            <img id="avatar" name="image" class="thumbnail" width="100%" height="350px"
                                                src="../users/import-img.png">
                                        </div>
                                        {!! show_errors_request($errors, 'image') !!}

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-light">Lưu thành viên</button>
                                    </div>
                                </div>
                            </form>
                        </div>
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
