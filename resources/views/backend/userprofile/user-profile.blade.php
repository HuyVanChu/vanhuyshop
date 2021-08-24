@extends('backend.master.master')
@section('title')
    Chi tiết quản trị {{ $user->name }}
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
                            <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="container">
                <div class="main-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <img src="../users/{{ $user->image }}" alt="Admin"
                                            class="rounded-circle p-1 bg-primary" width="110">
                                        <div class="mt-3">
                                            <h4>{{ $user->name }}</h4>
                                            <p class="mb-1">{{ $user->phone }}</p>
                                            <p class="font-size-sm">{{ $user->address }}</p>
                                        </div>
                                    </div>
                                    <hr class="my-4" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('admin_user_editDetailpost', ['id' => $user->id]) }}" method="post">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Tên</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{ $user->name }}"
                                                    name="name" />
                                                {!! show_errors_request($errors, 'name') !!}
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{ $user->email }}"
                                                    name="email" />
                                                {!! show_errors_request($errors, 'email') !!}
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Ngày sinh</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control"
                                                    value="{{ date('Y-m-d', strtotime($user->datetime)) }}"
                                                    name="datetime" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Điện thoại</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control" value="{{ $user->phone }}"
                                                    name="phone" />
                                                {!! alert_warning(session('thong-bao-loi')) !!}
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Địa chỉ</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{ $user->address }}"
                                                    name="address" />
                                                {!! show_errors_request($errors, 'address') !!}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9">
                                                <button type="submit" class="btn btn-light px-4">Lưu lại</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
