@extends('backend.master.master')
@section('title')
    Thêm hóa đơn
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
                            <li class="breadcrumb-item active" aria-current="page">Hóa đơn mới</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card">
                <div class="card-body p-4">
                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">
                                    <div class="search-bar flex-grow-1">
                                        <div class="position-relative search-bar-box">
                                            <input type="text" class="form-control search-control" placeholder="Nhập mã code sản phẩm"> <span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>
                                            <span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Tên sản phẩm</label>
                                        <input type="text" name="name" class="form-control" id="inputProductTitle" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Mã Code</label>
                                        <input type="text" name="code" class="form-control" id="inputProductTitle" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputPrice" class="form-label">Giá</label>
                                        <input type="number" name="price" class="form-control" id="inputPrice" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputCollection" class="form-label">Thương Hiệu</label>
                                        <input type="number" name="category" class="form-control" id="inputPrice" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputCollection" class="form-label">Danh mục</label>
                                        <input type="number" name="category" class="form-control" id="inputPrice" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">Product Images</label>
                                        <input id="image-uploadify" type="file"
                                            accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf"
                                            multiple>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="inputProductTags" class="form-label">Tên khách hàng</label>
                                            <input type="text" class="form-control" id="inputProductTags"
                                                placeholder="Enter Product Tags">
                                        </div>
                                        <div class="col-12">
                                            <label for="inputProductTags" class="form-label">Số điện thoại</label>
                                            <input type="text" class="form-control" id="inputProductTags"
                                                placeholder="Enter Product Tags">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="inputCompareatprice" class="form-label">Số lượng</label>
                                            <input type="number" class="form-control" id="inputCompareatprice" placeholder="">
                                          </div>
                                          <div class="col-md-6">
                                            <label for="inputCostPerPrice" class="form-label">Khuyến mại(%)</label>
                                            <input type="number" class="form-control" id="inputCostPerPrice" placeholder="">
                                          </div>
                                          <div class="col-12">
                                            <label for="inputProductTags" class="form-label">Email</label>
                                            <input type="text" class="form-control" id="inputProductTags"
                                                placeholder="Không bắt buộc">
                                        </div>
                                          <div class="col-12">
                                            <label for="inputProductTags" class="form-label">Địa chỉ</label>
                                            <input type="text" class="form-control" id="inputProductTags"
                                                placeholder="Nhập địa chỉ">
                                        </div>
                                        <div class="col-12">
                                            <label for="inputProductTags" class="form-label">Yêu cầu thêm:</label>

                                        </div>
                                        <div class="col-12">
                                            <textarea></textarea>
                                        </div>
                                          <div class="col-12">
                                            <button type="button" class="btn btn-success">Tính tiền</button>
                                        </div>
                                          <div class="col-12">
                                            <label for="inputProductTags" class="form-label">Tổng Tiền: 50000vnđ</label>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="button" class="btn btn-light">Thêm hóa đơn</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop
@endsection
