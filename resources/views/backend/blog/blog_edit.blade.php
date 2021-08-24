@extends('backend.master.master')
@section('title')
Sửa bài viết {{ $blog->title }}
@endsection
@section('main')
 <!--start page wrapper -->
 <div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i
                                    class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Sửa bài viết {{ $blog->title }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-4">
                <div class="form-body mt-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{ route('admin.editpostblog', ['id' => $blog->id,'slug' => $blog->slug]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="inputCompareatprice" class="form-label">Tên bài viết</label>
                                    <input type="text" class="form-control" name="title" value="{{ $blog->title }}">
                                </div>
                                {!! show_errors_request($errors, 'title') !!}
                                <div class="mb-3">
                                    <label for="inputCompareatprice" class="form-label">Giới thiệu bài viết</label>
                                    <input type="text" class="form-control" name="info" value="{{ $blog->info }}">
                                </div>
                                {!! show_errors_request($errors, 'info') !!}
                                <div class="mb-3">
                                    <label for="inputCompareatprice" class="form-label">Ảnh bài viết</label>
                                    <input id="img" type="file" name="image" class="form-control hidden"
                                        onchange="changeImg(this)">
                                    <img id="avatar" name="" class="thumbnail" width="100%" height="350px"
                                        src="../blogs/{{$blog->image}}">
                                </div>
                                <div class="mb-3">
                                    <label for="inputCompareatprice" class="form-label">Nội dung bài viết</label>
                                    <textarea class="form-control ckeditor" id="description" rows="3"
                                        name="body">{!! $blog->body !!}</textarea>
                                </div>
                                {!! show_errors_request($errors, 'body') !!}
                                <button style="float: right;" type="submit" class="btn btn-success">Sửa
                                    ngay</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function changeImg(input) {
        //Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            //Sự kiện file đã được load vào website
            reader.onload = function(e) {
                //Thay đổi đường dẫn ảnh
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
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('ckfinder/ckfinder.js') }}"></script>


@endsection
