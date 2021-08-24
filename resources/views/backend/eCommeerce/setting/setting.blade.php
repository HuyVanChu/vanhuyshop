@extends('backend.master.master')
@section('title')
    Cấu hình Website
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
                        <li class="breadcrumb-item active" aria-current="page">Cấu hình</li>
                    </ol>
                </nav>
            </div>
        </div>
        <h6 class="mb-0 text-uppercase">Cấu hình cho Website của bạn</h6>
        {!! show_errors_request($errors, 'image') !!}
        {!! show_errors_request($errors, 'slogan') !!}
        {!! show_errors_request($errors, 'icon') !!}
        {!! show_errors_request($errors, 'content') !!}
        {!! show_errors_request($errors, 'title') !!}
        {!! alert_success(session('thong-bao-thanh-cong')) !!}
        <hr>
        <div class="card">
            <div class="card-body">
                <div class="row row-cols-auto g-3">
                    <div class="col">
                        <button type="button" class="btn btn-dark px-5" data-bs-toggle="modal"
                            data-bs-target="#exampleDangerModal">Logo</button>
                        <div class="modal fade" id="exampleDangerModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content bg-dark">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-white">Cấu hình Logo Website</h5>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.logopost', ['id' => $setting->id]) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body text-white">
                                            <div class="mb-3">
                                                <input id="img" type="file" name="image" class="form-control hidden"
                                                    onchange="changeImg(this)">
                                                @if (isset($setting))
                                                    <img id="avatar" name="image" class="thumbnail" width="100%"
                                                        height="350px" src="../slogan/{{ $setting->logo }}">
                                                @else
                                                    <img id="avatar" name="image" class="thumbnail" width="100%"
                                                        height="350px" src="../slogan/1.png">
                                                @endif

                                            </div>
                                            <p>Lưu ý: khi thay đổi Logo Website của bạn sẽ thay đổi</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success"
                                                data-bs-dismiss="modal">Hủy</button>
                                            <button type="submit" class="btn btn-danger">Lưu thay đổi</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-dark px-5" data-bs-toggle="modal"
                            data-bs-target="#khauhieu">Khẩu hiệu</button>
                        <div class="modal fade" id="khauhieu" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content bg-dark">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-white">Cấu hình khẩu hiệu Website</h5>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.slogan', ['id' => $setting->id]) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body text-white">
                                            <div class="mb-3">
                                                <input type="text" name="slogan" class="form-control"
                                                    id="inputProductTitle" placeholder="Bắt buộc"
                                                    value="{{ $setting->slogan }}">
                                            </div>
                                            <p>Lưu ý: khi thay đổi khẩu hiệu Website của bạn sẽ thay đổi</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Hủy</button>
                                            <button type="submit" class="btn btn-light">Lưu thay đổi</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-dark px-5" data-bs-toggle="modal"
                            data-bs-target="#anhchinhsach">Ảnh chính sách</button>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h5 class="mb-0">Cấu hình Footer</h5>
                </div>
                <hr />
                <div class="row row-cols-auto g-3">
                    <div class="col">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                            data-bs-target="#footer{{ $footer->id }}">Chân
                            Trang 1</button>
                        <!-- Modal -->
                        <div class="modal fade" id="footer{{ $footer->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content bg-dark">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-white">Chân trang 1</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-white">
                                        <div class="mb-3">
                                            <p>Title:</p>
                                            <input type="text" name="title" class="form-control" placeholder="Bắt buộc"
                                                value="{{ $footer->title }}" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <p>Content:</p>
                                            <input type="text" name="footer_1" class="form-control"
                                                placeholder="Bắt buộc" value="{{ $footer->content }}" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <p>Lưu ý:</p>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#detailfooter{{ $footer->id }}">Chi tiết chân trang
                                                1</button>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                            data-bs-target="#footeredit{{ $footer->id }}">Sửa</button>
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Trở
                                            lại</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                            data-bs-target="#footer{{ $footer_2->id }}">Chân
                            Trang 2</button>
                        <!-- Modal -->
                        <div class="modal fade" id="footer{{ $footer_2->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content bg-dark">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-white">Chân trang 2</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-white">
                                        <div class="mb-3">
                                            <p>Title:</p>
                                            <input type="text" name="title" class="form-control" placeholder="Bắt buộc"
                                                value="{{ $footer_2->title }}" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <p>Content:</p>
                                            <input type="text" name="footer_1" class="form-control"
                                                placeholder="Bắt buộc" value="{{ $footer_2->content }}" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <p>Lưu ý:</p>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#detailfooter{{ $footer_2->id }}">Chi tiết chân trang
                                                2</button>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                            data-bs-target="#footeredit{{ $footer_2->id }}">Sửa</button>
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Trở
                                            lại</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                            data-bs-target="#footer{{ $footer_3->id }}">Chân
                            Trang 3</button>
                        <!-- Modal -->
                        <div class="modal fade" id="footer{{ $footer_3->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content bg-dark">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-white">Chân trang 3</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-white">
                                        <div class="mb-3">
                                            <p>Title:</p>
                                            <input type="text" name="title" class="form-control" placeholder="Bắt buộc"
                                                value="{{ $footer_3->title }}" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <p>Content:</p>
                                            <input type="text" name="footer_1" class="form-control"
                                                placeholder="Bắt buộc" value="{{ $footer_3->content }}" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <p>Lưu ý:</p>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#detailfooter{{ $footer_3->id }}">Chi tiết chân trang
                                                3</button>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                            data-bs-target="#footeredit{{ $footer_3->id }}">Sửa</button>
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Trở
                                            lại</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
</div>
{{-- edit detail footer3 --}}
<div class="modal fade" id="detailfooter{{ $footer_3->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title text-white">CHI TIẾT CHÂN TRANG 3</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <button type="button" class="btn btn-light" data-bs-toggle="modal"
                data-bs-target="#footerdetailadd{{ $footer_3->id }}">THÊM CHI TIẾT CHÂN TRANG 3</button>
            {{-- add detail footer2 --}}
            <div class="modal fade" id="footerdetailadd{{ $footer_3->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content bg-dark">
                        <div class="modal-header">
                            <h5 class="modal-title text-white">Thêm chân trang 3</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.adddetailfooter') }}" method="post">
                            @csrf
                            <div class="modal-body text-white">
                                <div class="mb-3">
                                    <input type="text" name="content" class="form-control" placeholder="Nội dung">
                                </div>
                                <p>Lưu ý:</p>
                                <p>1. Khi thêm chân trang, website của bạn sẽ thay đổi</p>
                                <p>2. Khi thêm chân trang, hãy truy cập sửa để thêm chi tiết chân trang</p>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="footer_2" value="{{ $footer_3->id }}">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
                                <button type="submit" class="btn btn-light">Thêm mới</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- end add detail footer2 --}}
            <div class="modal-body text-white">
                @foreach ($footer_3->footer_detail as $item)
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Title"
                            value="{{ $item->content }}" disabled>
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn btn-light" data-bs-toggle="modal"
                            data-bs-target="#footerdetailedit{{ $item->id }}">Sửa</button>
                        <button type="button" class="btn btn-light" data-bs-toggle="modal"
                            data-bs-target="#footerdetaildel{{ $item->id }}">Xóa</button>
                    </div>
                    {{-- edit footer detail --}}
                    <div class="modal fade" id="footerdetailedit{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content bg-dark">
                                <div class="modal-header">
                                    <h5 class="modal-title text-white">SỬA CHI TIẾT CHÂN TRANG 3</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                {{-- end add detail footer1 --}}
                                <form action="{{ route('admin.editdetailfooter', ['id' => $item->id]) }}"
                                    method="post">
                                    @csrf
                                    <div class="modal-body text-white">
                                        <div class="mb-3">
                                            <input type="text" name="title" class="form-control" placeholder="Title"
                                                value="{{ $item->content }}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="footer_id" value="{{ $footer_3->id }}">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
                                        <button type="submit" class="btn btn-light">Sửa mới</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- del footer detail --}}
                    <div class="modal fade" id="footerdetaildel{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content bg-dark">
                                <div class="modal-header">
                                    <h5 class="modal-title text-white">Xóa CHI TIẾT CHÂN TRANG 3</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="footer_id" value="{{ $footer_3->id }}">
                                    <a href="{{ route('admin.deldetailfooter', ['id' => $item->id]) }}"
                                        class="btn btn-light">Xóa</a>
                                    <button type="submit" class="btn btn-light">Hủy</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
{{-- edit detail footer2 --}}
<div class="modal fade" id="detailfooter{{ $footer_2->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title text-white">CHI TIẾT CHÂN TRANG 2</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <button type="button" class="btn btn-light" data-bs-toggle="modal"
                data-bs-target="#footerdetailadd{{ $footer_2->id }}">THÊM CHI TIẾT CHÂN TRANG 2</button>
            {{-- add detail footer2 --}}
            <div class="modal fade" id="footerdetailadd{{ $footer_2->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content bg-dark">
                        <div class="modal-header">
                            <h5 class="modal-title text-white">Thêm chân trang 2</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.adddetailfooter') }}" method="post">
                            @csrf
                            <div class="modal-body text-white">
                                <div class="mb-3">
                                    <input type="text" name="content" class="form-control" placeholder="Nội dung">
                                </div>
                                <p>Lưu ý:</p>
                                <p>1. Khi thêm chân trang, website của bạn sẽ thay đổi</p>
                                <p>2. Khi thêm chân trang, hãy truy cập sửa để thêm chi tiết chân trang</p>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="footer_2" value="{{ $footer_2->id }}">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
                                <button type="submit" class="btn btn-light">Thêm mới</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- end add detail footer2 --}}
            <div class="modal-body text-white">
                @foreach ($footer_2->footer_detail as $item)
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Title"
                            value="{{ $item->content }}" disabled>
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn btn-light" data-bs-toggle="modal"
                            data-bs-target="#footerdetailedit{{ $item->id }}">Sửa</button>
                        <button type="button" class="btn btn-light" data-bs-toggle="modal"
                            data-bs-target="#footerdetaildel{{ $item->id }}">Xóa</button>
                        {{-- <a href="{{route('admin.deldetailfooter',['id'=>$item->id])}}" class="btn btn-light">Xóa</a> --}}
                    </div>
                    {{-- edit footer detail --}}
                    <div class="modal fade" id="footerdetailedit{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content bg-dark">
                                <div class="modal-header">
                                    <h5 class="modal-title text-white">SỬA CHI TIẾT CHÂN TRANG 1</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                {{-- end add detail footer1 --}}
                                <form action="{{ route('admin.editdetailfooter', ['id' => $item->id]) }}"
                                    method="post">
                                    @csrf
                                    <div class="modal-body text-white">
                                        <div class="mb-3">
                                            <input type="text" name="title" class="form-control" placeholder="Title"
                                                value="{{ $item->content }}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="footer_id" value="{{ $footer_2->id }}">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
                                        <button type="submit" class="btn btn-light">Sửa mới</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- del footer detail --}}
                    <div class="modal fade" id="footerdetaildel{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content bg-dark">
                                <div class="modal-header">
                                    <h5 class="modal-title text-white">Xóa CHI TIẾT CHÂN TRANG 2</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="footer_id" value="{{ $footer_2->id }}">
                                    <a href="{{ route('admin.deldetailfooter', ['id' => $item->id]) }}"
                                        class="btn btn-light">Xóa</a>
                                    <button type="submit" class="btn btn-light">Hủy</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
{{-- edit footer2 --}}
<div class="modal fade" id="footeredit{{ $footer_3->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title text-white">SỬA CHÂN TRANG 2</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.editfooter', ['id' => $footer_3->id]) }}" method="post">
                @csrf
                <div class="modal-body text-white">
                    <div class="mb-3">
                        <input type="text" name="title" class="form-control" placeholder="Title"
                            value="{{ $footer_3->title }}">
                    </div>
                    <div class="mb-3">
                        <input type="text" name="content" class="form-control" placeholder="Nội dung"
                            value="{{ $footer_3->content }}">
                    </div>
                    <p>Lưu ý:</p>
                    <p>1. Khi sửa chân trang, website của bạn sẽ thay đổi</p>
                    <p>2. Khi sửa chân trang, hãy truy cập sửa để sửa chi tiết chân trang</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-light">Sửa mới</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- edit footer2 --}}
<div class="modal fade" id="footeredit{{ $footer_2->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title text-white">SỬA CHÂN TRANG 2</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.editfooter', ['id' => $footer_2->id]) }}" method="post">
                @csrf
                <div class="modal-body text-white">
                    <div class="mb-3">
                        <input type="text" name="title" class="form-control" placeholder="Title"
                            value="{{ $footer_2->title }}">
                    </div>
                    <div class="mb-3">
                        <input type="text" name="content" class="form-control" placeholder="Nội dung"
                            value="{{ $footer_2->content }}">
                    </div>
                    <p>Lưu ý:</p>
                    <p>1. Khi sửa chân trang, website của bạn sẽ thay đổi</p>
                    <p>2. Khi sửa chân trang, hãy truy cập sửa để sửa chi tiết chân trang</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-light">Sửa mới</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- edit detail footer1 --}}
<div class="modal fade" id="detailfooter{{ $footer->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title text-white">CHI TIẾT CHÂN TRANG 1</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <button type="button" class="btn btn-light" data-bs-toggle="modal"
                data-bs-target="#footerdetailadd1{{ $footer->id }}">THÊM MỚI CHI TIẾT CHÂN TRANG
                1</button>
            {{-- add detail footer1 --}}
            <div class="modal fade" id="footerdetailadd1{{ $footer->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content bg-dark">
                        <div class="modal-header">
                            <h5 class="modal-title text-white">Thêm chân trang 1</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.adddetailfooter') }}" method="post">
                            @csrf
                            <div class="modal-body text-white">
                                <div class="mb-3">
                                    <input type="text" name="content" class="form-control" placeholder="Nội dung">
                                </div>
                                <p>Lưu ý:</p>
                                <p>1. Khi thêm chân trang, website của bạn sẽ thay đổi</p>
                                <p>2. Khi thêm chân trang, hãy truy cập sửa để thêm chi tiết chân
                                    trang</p>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="footer_2" value="{{ $footer->id }}">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
                                <button type="submit" class="btn btn-light">Thêm mới</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal-body text-white">
                @foreach ($footer->footer_detail as $item)
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Title"
                            value="{{ $item->content }}" disabled>
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn btn-light" data-bs-toggle="modal"
                            data-bs-target="#footerdetailedit{{ $item->id }}">Sửa</button>
                        <button type="button" class="btn btn-light" data-bs-toggle="modal"
                            data-bs-target="#footerdetaildel{{ $item->id }}">Xóa</button>
                    </div>
                    {{-- edit footer detail --}}
                    <div class="modal fade" id="footerdetailedit{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content bg-dark">
                                <div class="modal-header">
                                    <h5 class="modal-title text-white">SỬA CHI TIẾT CHÂN TRANG 1</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.editdetailfooter', ['id' => $item->id]) }}"
                                    method="post">
                                    @csrf
                                    <div class="modal-body text-white">
                                        <div class="mb-3">
                                            <input type="text" name="title" class="form-control" placeholder="Title"
                                                value="{{ $item->content }}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="footer_id" value="{{ $footer->id }}">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
                                        <button type="submit" class="btn btn-light">Sửa mới</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- del footer detail --}}
                    <div class="modal fade" id="footerdetaildel{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content bg-dark">
                                <div class="modal-header">
                                    <h5 class="modal-title text-white">Xóa CHI TIẾT CHÂN TRANG</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="footer_id" value="{{ $footer->id }}">
                                    <a href="{{ route('admin.deldetailfooter', ['id' => $item->id]) }}"
                                        class="btn btn-light">Xóa</a>
                                    <button type="submit" class="btn btn-light">Hủy</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
{{-- edit footer1 --}}
<div class="modal fade" id="footeredit{{ $footer->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title text-white">SỬA CHÂN TRANG 1</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.editfooter', ['id' => $footer->id]) }}" method="post">
                @csrf
                <div class="modal-body text-white">
                    <div class="mb-3">
                        <input type="text" name="title" class="form-control" placeholder="Title"
                            value="{{ $footer->title }}">
                    </div>
                    <div class="mb-3">
                        <input type="text" name="content" class="form-control" placeholder="Nội dung"
                            value="{{ $footer->content }}">
                    </div>
                    <p>Lưu ý:</p>
                    <p>1. Khi sửa chân trang, website của bạn sẽ thay đổi</p>
                    <p>2. Khi sửa chân trang, hãy truy cập sửa để sửa chi tiết chân trang</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-light">Sửa mới</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- image policy --}}
<div class="modal fade" id="anhchinhsach" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title text-white">Cấu hình ảnh chính sách Website</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#themmoiimagepolycy">Thêm
                mới</button>
            <div class="modal-body text-white">
                @foreach ($image_policy as $item)
                    <div class="mb-3">
                        <p>Code: {{ $item->id }}</p>
                        <input type="text" name="icon" class="form-control" id="inputProductTitle"
                            placeholder="Bắt buộc" value="{{ $item->icon }}" disabled>
                    </div>
                    <div class="mb-3">
                        <p>Code: {{ $item->id }}</p>
                        <input type="text" name="content" class="form-control" id="inputProductTitle"
                            placeholder="Bắt buộc" value="{{ $item->content }}" disabled>
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#suaimagepolycy{{ $item->id }}">Sửa</button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#xoaimagepolycy{{ $item->id }}">Xóa</button>
                    </div>
                    {{-- edit image policy --}}
                    <div class="modal fade" id="suaimagepolycy{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content bg-dark">
                                <div class="modal-header">
                                    <h5 class="modal-title text-white">Cấu hình khẩu hiệu Website</h5>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.edit.image.policy', ['id' => $item->id]) }}"
                                    method="post">
                                    @csrf
                                    <div class="modal-body text-white">
                                        <div class="mb-3">
                                            <input type="text" name="icon" class="form-control" placeholder="icont"
                                                value="{{ $item->icon }}">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" name="content" class="form-control"
                                                placeholder="Nội dung" value="{{ $item->content }}">
                                        </div>
                                        <p>Lưu ý: khi thay đổi Website của bạn sẽ thay đổi</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success"
                                            data-bs-dismiss="modal">Hủy</button>
                                        <button type="submit" class="btn btn-danger">Sửa</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- delete image policy --}}
                    <div class="modal fade" id="xoaimagepolycy{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content bg-dark">
                                <div class="modal-header">
                                    <h5 class="modal-title text-white">Xóa ảnh chính sách Website</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-white">
                                    <div class="mb-3">
                                        <input type="text" name="icon" class="form-control" placeholder="icont"
                                            value="{{ $item->icon }}" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" name="content" class="form-control" placeholder="Nội dung"
                                            value="{{ $item->content }}" disabled>
                                    </div>
                                    <p>Lưu ý: khi xóa nó Website của bạn sẽ thay đổi</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Hủy</button>
                                    <a href="{{ route('admin.delete.image.policy', ['id' => $item->id]) }}"
                                        class="btn btn-danger">Xóa</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <p>Lưu ý: khi thay đổi Website của bạn sẽ thay đổi</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Trở lại</button>
            </div>
        </div>
    </div>
</div>
{{-- add footer --}}
<div class="modal fade" id="themmoifooter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title text-white">Thêm chân trang Website</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.addfooter') }}" method="post">
                @csrf
                <div class="modal-body text-white">
                    <div class="mb-3">
                        <input type="text" name="icon" class="form-control" placeholder="Title">
                    </div>
                    <p>Lưu ý:</p>
                    <p>1. Khi thêm chân trang, website của bạn sẽ thay đổi</p>
                    <p>2. Khi thêm chân trang, hãy truy cập sửa để thêm chi tiết chân trang</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-light">Thêm mới</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- add.image.policy --}}
<div class="modal fade" id="themmoiimagepolycy" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title text-white">Thêm ảnh chính sách Website</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.add.image.policy') }}" method="post">
                @csrf
                <div class="modal-body text-white">
                    <div class="mb-3">
                        <input type="text" name="icon" class="form-control" placeholder="icont">
                    </div>
                    <div class="mb-3">
                        <input type="text" name="content" class="form-control" placeholder="Nội dung">
                    </div>
                    <p>Lưu ý: khi thay đổi khẩu hiệu Website của bạn sẽ thay đổi</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-light">Thêm mới</button>
                </div>
            </form>
        </div>
    </div>
</div>
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

@endsection
