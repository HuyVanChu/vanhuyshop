@extends('backend.master.master')
@section('title')
    Sửa Title 1
@endsection
@section('main')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Cấu hình</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            @if (isset($subtitle1))
            <h6 class="mb-0 text-uppercase">Sửa Title 1</h6>
            <hr>
            <div class="card">
                <div class="card-body">
                    <div class="row row-cols-auto g-3">
                        <div class="col">
                            <form method="post">
                                @csrf
                                <div class="modal-content bg-dark">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-white">Title 1</h5>
                                        <a href="{{route('admin.settingcontact')}}" class="btn-close"></a>
                                    </div>
                                    <div class="modal-body text-white">
                                        <div class="mb-3">
                                            <textarea name="title1"
                                                class="form-control ckeditor">{{ $contact->title1 }}</textarea>
                                        </div>
                                        <p>Lưu ý:</p>
                                        <p>1. Khi sửa title, trang liên hệ của bạn sẽ thay đổi</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{route('admin.settingcontact')}}" class="btn btn-success">Hủy</a>
                                        <button type="submit" class="btn btn-danger" name="subtitle1"
                                            value="{{ $contact->id }}">Sửa mới</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
            @elseif(isset($subtitle2))
            <h6 class="mb-0 text-uppercase">Sửa Title 2</h6>
            <hr>
            <div class="card">
                <div class="card-body">
                    <div class="row row-cols-auto g-3">
                        <div class="col">
                            <form method="post">
                                @csrf
                                <div class="modal-content bg-dark">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-white">Title 2</h5>
                                        <a href="{{route('admin.settingcontact')}}" class="btn-close"></a>
                                    </div>
                                    <div class="modal-body text-white">
                                        <div class="mb-3">
                                            <textarea name="title2"
                                                class="form-control ckeditor">{{ $contact->title2 }}</textarea>
                                        </div>
                                        <p>Lưu ý:</p>
                                        <p>1. Khi sửa title, trang liên hệ của bạn sẽ thay đổi</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{route('admin.settingcontact')}}" class="btn btn-success">Hủy</a>
                                        <button type="submit" class="btn btn-danger" name="subtitle2"
                                            value="{{ $contact->id }}">Sửa mới</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
            @elseif(isset($subtitle3))
            <h6 class="mb-0 text-uppercase">Sửa Title 3</h6>
            <hr>
            <div class="card">
                <div class="card-body">
                    <div class="row row-cols-auto g-3">
                        <div class="col">
                            <form method="post">
                                @csrf
                                <div class="modal-content bg-dark">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-white">Title 3</h5>
                                        <a href="{{route('admin.settingcontact')}}" class="btn-close"></a>
                                    </div>
                                    <div class="modal-body text-white">
                                        <div class="mb-3">
                                            <textarea name="title3"
                                                class="form-control ckeditor">{{ $contact->title3 }}</textarea>
                                        </div>
                                        <p>Lưu ý:</p>
                                        <p>1. Khi sửa title, trang liên hệ của bạn sẽ thay đổi</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{route('admin.settingcontact')}}" class="btn btn-success">Hủy</a>
                                        <button type="submit" class="btn btn-light" name="subtitle3"
                                            value="{{ $contact->id }}">Sửa mới</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
            @endif

        </div>
    </div>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('ckfinder/ckfinder.js') }}"></script>
@endsection
