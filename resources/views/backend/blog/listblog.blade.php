@extends('backend.master.master')
@section('title')
    Danh sách bài viết
@endsection
@section('main')
    @if (isset($blogs))

        <div class="page-wrapper">
            <div class="page-content">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i
                                            class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Danh sách bài viết</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-lg-3 col-xl-2">
                                        <a href="{{ route('admin.blogadd') }}" class="btn btn-light mb-3 mb-lg-0">
                                            <i class='bx bxs-plus-square'></i>Thêm
                                        </a>
                                    </div>

                                    <div class="col-lg-9 col-xl-10">
                                        <form class="float-lg-end" action="{{ route('admin.blogsearch') }}" method="get">

                                            <div class="row row-cols-lg-auto g-2">
                                                <div class="col-12">
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control ps-5"
                                                            placeholder="Tìm bài viết..." name="q"> <span
                                                            class="position-absolute top-50 product-show translate-middle-y"><i
                                                                class="bx bx-search"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {!! alert_success(session('thong-bao')) !!}
                <hr />
                <div class="d-flex align-items-center">
                    @if (isset($count))
                        Tìm thấy {{ $count }} bài viết với từ khóa "{{ $namesearch }}""
                    @endif
                    <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2">


                    @foreach ($blogs as $blog)
                        <div class="col">
                            <div class="card mb-3">
                                <a href="" data-bs-toggle="modal" data-bs-target="#blogdetail{{ $blog->id }}"><img
                                        src="../blogs/{{ $blog->image }}" width="960" height="300"
                                        class="card-img-top" alt="{{ $blog->title }}"></a>

                                <div class="card-body">
                                    <a href="" data-bs-toggle="modal" data-bs-target="#blogdetail{{ $blog->id }}">
                                        <h5 class="card-title">{{ $blog->title }}</h5>
                                    </a>
                                    {{-- info --}}
                                    <p class="card-text">{{ substr($blog->info, 0, 50)  }}...</p>
                                         {{-- end info --}}
                                    {{-- check time create new --}}
                                    <?php $tamp = Carbon\Carbon::now()->diff($blog->created_at); ?>
                                    @if ($tamp->format('%y') > 0)
                                        <p class="card-text"><small
                                                class="">{{ Carbon\Carbon::now()->diff($blog->created_at)->format('%y năm %m tháng %h giờ %i phút %s giây trước4') }}</small>
                                        </p>
                                    @elseif ($tamp->format('%m') > 0)
                                        <p class="card-text"><small
                                                class="">{{ Carbon\Carbon::now()->diff($blog->created_at)->format('%m tháng %h giờ %i phút %s giây trước23') }}</small>
                                        </p>
                                    @elseif ($tamp->format('%d') > 0)
                                        <p class="card-text"><small
                                                class="">{{ Carbon\Carbon::now()->diff($blog->created_at)->format('%d ngày %h giờ %i phút %s giây trước2') }}</small>
                                        </p>
                                    @elseif ($tamp->format('%h') > 0)
                                        <p class="card-text"><small
                                                class="">{{ Carbon\Carbon::now()->diff($blog->created_at)->format('%h giờ %i phút %s giây trước') }}</small>
                                        </p>
                                    @elseif ($tamp->format('%i') > 0)
                                        <p class="card-text"><small
                                                class="">{{ Carbon\Carbon::now()->diff($blog->created_at)->format('%i phút %s giây trước') }}</small>
                                        </p>
                                    @else
                                        <p class="card-text"><small
                                                class="">{{ Carbon\Carbon::now()->diff($blog->created_at)->format('%s giây trước') }}</small>
                                        </p>
                                    @endif
                                    {{-- end check time create new --}}
                                </div>
                                <div class="cart-body">
                                    <a href="" data-bs-toggle="modal" data-bs-target="#blogdetail{{ $blog->id }}"
                                        class="btn btn-success">Xem
                                        chi tiết</a>
                                    <a href="{{ route('admineditblog', ['id' => $blog->id, 'slug' => $blog->slug]) }}"
                                        class="btn btn-warning">Sửa bài viết</a>
                                    <a href="" data-bs-toggle="modal" data-bs-target="#remove{{ $blog->id }}"
                                        class="btn btn-danger">Xóa bài viết</a>

                                </div>
                                <!-- detail -->
                                <div class="modal fade" id="blogdetail{{ $blog->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content bg-dark">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-white">Bài viết: {{ $blog->title }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-white">
                                                <div class="mb-3">
                                                    <h5 class="modal-title text-white">Tiêu đề</h5>
                                                    <input type="text" name="slogan" class="form-control"
                                                        id="inputProductTitle" placeholder="Bắt buộc"
                                                        value="{{ $blog->title }}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <h5 class="modal-title text-white">Ngày tạo</h5>
                                                    <input type="text" name="slogan" class="form-control"
                                                        id="inputProductTitle" placeholder="Bắt buộc"
                                                        value="{{ date('d-m-Y', strtotime($blog->created_at)) }}"
                                                        disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <h5 class="modal-title text-white">Người tạo</h5>
                                                    <input type="text" name="slogan" class="form-control"
                                                        id="inputProductTitle" placeholder="Bắt buộc"
                                                        value="{{ $blog->Admin->name }}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <h5 class="modal-title text-white">Nội dung</h5>
                                                </div>
                                                {!! $blog->body !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- detail -->
                                <!-- remove -->
                                <div class="modal fade" id="remove{{ $blog->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content bg-dark">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-white">Bạn muốn xóa bài viết:
                                                    {{ $blog->title }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <a href="{{ route('admin.removeblog', ['id' => $blog->id]) }}"
                                                class="btn btn-danger">Xóa</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- remove -->
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{ $blogs->links() }}
        </div>
    @endif
@endsection
