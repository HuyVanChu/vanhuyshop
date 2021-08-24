@extends('backend.master.master')
@section('title')
    Sửa quản trị Website {{ $userItem->name }}
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
                            <li class="breadcrumb-item active" aria-current="page">Admin/Sửa quản trị
                                {{ $userItem->name }}
                            </li>

                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card">
                <div class="card-body p-4">
                    <div class="form-body mt-4">
                        <div class="row">
                            {!! alert_warning(session('thong-bao-loi')) !!}
                            <form action="{{ route('admin_user_edit_post', ['id' => $userItem->id]) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-12">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="mb-3">
                                            <label for="inputVendor" class="form-label">Tên</label>
                                            <input type="text" name="name" class="form-control" id="inputProductTitle"
                                                placeholder="Bắt buộc" value="{{ $userItem->name }}">
                                        </div>
                                        {!! show_errors_request($errors, 'name') !!}

                                        <div class="mb-3">
                                            <label for="inputVendor" class="form-label">Điện thoại</label>
                                            <input type="text" name="phone" class="form-control" id="inputProductTitle"
                                                placeholder="Bắt buộc" value="{{ $userItem->phone }}">
                                        </div>
                                        {!! show_errors_request($errors, 'phone') !!}
                                        <div class="mb-3">
                                            <label for="inputVendor" class="form-label">Địa chỉ</label>
                                            <input type="text" name="address" class="form-control" id="inputProductTitle"
                                                placeholder="Bắt buộc" value="{{ $userItem->address }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputVendor" class="form-label">Ngày sinh</label>
                                            <input type="date" name="datetime" class="form-control" id="inputProductTitle"
                                                placeholder="Bắt buộc"
                                                value="{{ date('Y-m-d', strtotime($userItem->datetime)) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputProductTitle" class="form-label">Email</label>
                                            <input type="text" name="email" class="form-control" id="inputProductTitle"
                                                placeholder="Bắt buộc" value="{{ $userItem->email }}">
                                        </div>
                                        {!! show_errors_request($errors, 'email') !!}
                                        <div class="mb-3">
                                            <label for="inputProductDescription" class="form-label">Ảnh</label>
                                            <input id="img" type="file" name="image" class="form-control hidden"
                                                onchange="changeImg(this)">
                                            <img id="avatar" name="image" class="thumbnail" width="100%" height="350px"
                                                src="../users/{{ $userItem->image }}">
                                        </div>
                                        {!! show_errors_request($errors, 'image') !!}
                                        <div class="mb-3">
                                            {{-- <input type="checkbox" name="add"
                                                {{ $userItem->hasPermissionTo('add') ? 'checked' : '' }}><label>
                                                Sửa</label><br />
                                            <input type="checkbox" name="edit"
                                                {{ $userItem->hasPermissionTo('edit') ? 'checked' : '' }}><label>
                                                Sửa</label><br />
                                            <input type="checkbox" name="delete"
                                                {{ $userItem->hasPermissionTo('delete') ? 'checked' : '' }}><label>
                                                Xóa</label><br /> --}}
                                            {{-- @role('super-admin', 'web')
                                            1
                                            @else
                                            2
                                            @endrole --}}
                                            <label for="inputProductDescription" class="form-label">Phân quyền quản trị</label>
                                            <!-- Table  -->
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Xem</th>
                                                        <th>Thêm</th>
                                                        <th>Sửa</th>
                                                        <th>Xóa</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck2" name="view_product"
                                                            {!!show_ruler($userItem,'view_product')!!}
                                                            >
                                                            <label class="custom-control-label" for="tableDefaultCheck2">Xem bài viết</label>
                                                        </div>
                                                        </td>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck2" name="add_product"
                                                            {!!show_ruler($userItem,'add_product')!!}
                                                            >
                                                            <label class="custom-control-label" for="tableDefaultCheck2">Thêm sản phẩm</label>
                                                        </div>
                                                        </td>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck2" name="edit_product"
                                                            {!!show_ruler($userItem,'edit_product')!!}
                                                            >
                                                            <label class="custom-control-label" for="tableDefaultCheck2">Sửa sản phẩm</label>
                                                        </div>
                                                        </td>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck2" name="delete_product"
                                                            {!!show_ruler($userItem,'delete_product')!!}
                                                            >
                                                            <label class="custom-control-label" for="tableDefaultCheck2">Xóa sản phẩm</label>
                                                        </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck3" name="view_user"
                                                            {!!show_ruler($userItem,'view_user')!!}
                                                            >
                                                            <label class="custom-control-label" for="tableDefaultCheck3">Xem danh sách quản trị</label>
                                                        </div>
                                                        </td>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck3" name="add_user"
                                                            {!!show_ruler($userItem,'add_user')!!}
                                                            >
                                                            <label class="custom-control-label" for="tableDefaultCheck3">Thêm quản trị</label>
                                                        </div>
                                                        </td>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck3" name="edit_user"
                                                            {!!show_ruler($userItem,'edit_user')!!}
                                                            >
                                                            <label class="custom-control-label" for="tableDefaultCheck3">Sửa quản trị</label>
                                                        </div>
                                                        </td>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck3" name="delete_user"
                                                            {!!show_ruler($userItem,'delete_user')!!}
                                                            >
                                                            <label class="custom-control-label" for="tableDefaultCheck3">Xóa quản trị</label>
                                                        </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="view_category"
                                                            {!!show_ruler($userItem,'view_category')!!}
                                                            >
                                                            <label class="custom-control-label" for="tableDefaultCheck4">Xem danh mục</label>
                                                        </div>
                                                        </td>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="add_category"
                                                            {!!show_ruler($userItem,'add_category')!!}
                                                            >
                                                            <label class="custom-control-label" for="tableDefaultCheck4">Thêm danh mục</label>
                                                        </div>
                                                        </td>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="edit_category"
                                                            {!!show_ruler($userItem,'edit_category')!!}
                                                            >
                                                            <label class="custom-control-label" for="tableDefaultCheck4">Sửa danh mục</label>
                                                        </div>
                                                        </td>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="delete_category"
                                                            {!!show_ruler($userItem,'delete_category')!!}
                                                            >
                                                            <label class="custom-control-label" for="tableDefaultCheck4">Xóa danh mục</label>
                                                        </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="view_order"
                                                            {!!show_ruler($userItem,'view_order')!!}
                                                            >
                                                            <label class="custom-control-label" for="tableDefaultCheck4">Xem hóa đơn</label>
                                                        </div>
                                                        </td>
                                                        <td>

                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="edit_order"
                                                                {!!show_ruler($userItem,'edit_order')!!}
                                                                >
                                                                <label class="custom-control-label" for="tableDefaultCheck4">Xử lý</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="delete_order"
                                                            {!!show_ruler($userItem,'delete_order')!!}
                                                                >
                                                            <label class="custom-control-label" for="tableDefaultCheck4">Xóa hóa đơn</label>
                                                        </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="view_comment_product"
                                                            {!!show_ruler($userItem,'view_comment_product')!!}
                                                                >
                                                            <label class="custom-control-label" for="tableDefaultCheck4">Xem bình luận sản phẩm</label>
                                                        </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="add_comment_product"
                                                                {!!show_ruler($userItem,'add_comment_product')!!}
                                                                >
                                                                <label class="custom-control-label" for="tableDefaultCheck4">Trả lời bình luận sản phẩm</label>
                                                            </div>
                                                        </td>
                                                        <td>

                                                        </td>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="delete_comment_product"
                                                            {!!show_ruler($userItem,'delete_comment_product')!!}
                                                                >
                                                            <label class="custom-control-label" for="tableDefaultCheck4">Xóa bình luận sản phẩm</label>
                                                        </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="view_comment_blog"
                                                            {!!show_ruler($userItem,'view_comment_blog')!!}
                                                            >
                                                            <label class="custom-control-label" for="tableDefaultCheck4">Xem bình luận bài viết</label>
                                                        </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="view_comment_blog"
                                                                {!!show_ruler($userItem,'view_comment_blog')!!}
                                                                >
                                                                <label class="custom-control-label" for="tableDefaultCheck4">Trả lời bình luận bài viết</label>
                                                            </div>
                                                        </td>
                                                        <td>

                                                        </td>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="delete_comment_blog"
                                                            {!!show_ruler($userItem,'delete_comment_blog')!!}
                                                                >
                                                            <label class="custom-control-label" for="tableDefaultCheck4">Xóa bình luận bài viết</label>
                                                        </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="view_blog"
                                                            {!!show_ruler($userItem,'view_blog')!!}
                                                                >
                                                            <label class="custom-control-label" for="tableDefaultCheck4">Xem bài viết</label>
                                                        </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="add_blog"
                                                                {!!show_ruler($userItem,'add_blog')!!}
                                                                >
                                                                <label class="custom-control-label" for="tableDefaultCheck4">Trả lời bài viết</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="edit_blog"
                                                                {!!show_ruler($userItem,'edit_blog')!!}
                                                                >
                                                                <label class="custom-control-label" for="tableDefaultCheck4">Trả lời bài viết</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="delete_blog"
                                                            {!!show_ruler($userItem,'delete_blog')!!}
                                                                >
                                                            <label class="custom-control-label" for="tableDefaultCheck4">Xóa bài viết</label>
                                                        </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="view_trademark"
                                                            {!!show_ruler($userItem,'view_trademark')!!}
                                                                >
                                                            <label class="custom-control-label" for="tableDefaultCheck4">Xem thương hiệu</label>
                                                        </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="add_trademark"
                                                                {!!show_ruler($userItem,'add_trademark')!!}
                                                                >
                                                                <label class="custom-control-label" for="tableDefaultCheck4">Thêm thương hiệu</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="edit_trademark"
                                                                {!!show_ruler($userItem,'edit_trademark')!!}
                                                                >
                                                                <label class="custom-control-label" for="tableDefaultCheck4">Sửa thương hiệu</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="delete_trademark"
                                                            {!!show_ruler($userItem,'delete_trademark')!!}
                                                                >
                                                            <label class="custom-control-label" for="tableDefaultCheck4">Xóa thương hiệu</label>
                                                        </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="view_logo"
                                                            {!!show_ruler($userItem,'view_logo')!!}
                                                                >
                                                            <label class="custom-control-label" for="tableDefaultCheck4">Xem Logo</label>
                                                        </div>
                                                        </td>
                                                        <td>

                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="edit_logo"
                                                                {!!show_ruler($userItem,'edit_logo')!!}
                                                                >
                                                                <label class="custom-control-label" for="tableDefaultCheck4">Sửa Logo</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">

                                                        </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="view_slogan"
                                                            {!!show_ruler($userItem,'view_slogan')!!}
                                                                >
                                                            <label class="custom-control-label" for="tableDefaultCheck4">Xem slogan</label>
                                                        </div>
                                                        </td>

                                                        <td>
                                                           
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="edit_slogan"
                                                                {!!show_ruler($userItem,'edit_slogan')!!}
                                                                >
                                                                <label class="custom-control-label" for="tableDefaultCheck4">Sửa slogan</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">

                                                        </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="view_image_polyci"
                                                            {!!show_ruler($userItem,'view_image_polyci')!!}
                                                                >
                                                            <label class="custom-control-label" for="tableDefaultCheck4">Xem ảnh chính sách</label>
                                                        </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="add_image_polyci"
                                                                {!!show_ruler($userItem,'add_image_polyci')!!}
                                                                >
                                                                <label class="custom-control-label" for="tableDefaultCheck4">Thêm ảnh chính sách</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="edit_image_polyci"
                                                                {!!show_ruler($userItem,'edit_image_polyci')!!}
                                                                >
                                                                <label class="custom-control-label" for="tableDefaultCheck4">Sửa ảnh chính sách</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="delete_image_polyci"
                                                            {!!show_ruler($userItem,'delete_image_polyci')!!}
                                                                >
                                                            <label class="custom-control-label" for="tableDefaultCheck4">Xóa ảnh chính sách</label>
                                                        </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">

                                                        </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="add_footer"
                                                                {!!show_ruler($userItem,'add_footer')!!}
                                                                >
                                                                <label class="custom-control-label" for="tableDefaultCheck4">Thêm chân trang</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="edit_footer"
                                                                {!!show_ruler($userItem,'edit_footer')!!}
                                                                >
                                                                <label class="custom-control-label" for="tableDefaultCheck4">Sửa chân trang</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="delete_footer"
                                                            {!!show_ruler($userItem,'delete_footer')!!}
                                                                >
                                                            <label class="custom-control-label" for="tableDefaultCheck4">Xóa chân trang</label>
                                                        </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">

                                                        </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="add_detail_footer"
                                                                {!!show_ruler($userItem,'add_detail_footer')!!}
                                                                >
                                                                <label class="custom-control-label" for="tableDefaultCheck4">Thêm chi tiết chân trang</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="edit_detail_footer"
                                                                {!!show_ruler($userItem,'edit_detail_footer')!!}
                                                                >
                                                                <label class="custom-control-label" for="tableDefaultCheck4">Sửa chi tiết chân trang</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="delete_detail_footer"
                                                            {!!show_ruler($userItem,'delete_detail_footer')!!}
                                                                >
                                                            <label class="custom-control-label" for="tableDefaultCheck4">Xóa chi tiết chân trang</label>
                                                        </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="view_slide"
                                                            {!!show_ruler($userItem,'view_slide')!!}
                                                                >
                                                            <label class="custom-control-label" for="tableDefaultCheck4">Xem Slide</label>
                                                        </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="add_slide"
                                                                {!!show_ruler($userItem,'add_slide')!!}
                                                                >
                                                                <label class="custom-control-label" for="tableDefaultCheck4">Thêm Slide</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="edit_slide"
                                                                {!!show_ruler($userItem,'edit_slide')!!}
                                                                >
                                                                <label class="custom-control-label" for="tableDefaultCheck4">Sửa Slide</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="delete_slide"
                                                            {!!show_ruler($userItem,'delete_slide')!!}
                                                                >
                                                            <label class="custom-control-label" for="tableDefaultCheck4">Xóa Slide</label>
                                                        </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="view_contact"
                                                            {!!show_ruler($userItem,'view_contact')!!}
                                                                >
                                                            <label class="custom-control-label" for="tableDefaultCheck4">Xem trang liên hệ Website</label>
                                                        </div>
                                                        </td>
                                                        <td>

                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4" name="edit_contact"
                                                                {!!show_ruler($userItem,'edit_contact')!!}
                                                                >
                                                                <label class="custom-control-label" for="tableDefaultCheck4">Sửa trang liên hệ Website</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                        <div class="custom-control custom-checkbox">

                                                        </div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            <!-- Table  -->

                                        </div>
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
