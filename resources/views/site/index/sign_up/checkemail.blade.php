@extends('site.index.master.layout')
@section('title')
    Lấy lại mật khẩu
@endsection
@section('main')
    <div class="main-container">
        <div class="container">
            <div class="row">
                <div class="main">
                    <div class="col-md-6 col-sm-12">
                        <div class="login-form">
                            <div class="text-center">
                                <h3 class="">Lấy lại mật khẩu</h3>
                            </div>
                            <div class="text-center">
                                <p class="">Chúng tôi đã gửi 1 mã đến email của bạn</p>
                            </div>
                            <form class="row g-3" action="{{route('checkemail')}}" method="POST">
                                @csrf
                                <p>
                                    <input type="text" class="form-control" id="inputEmailAddress" placeholder="Nhập mã code"
                                        name="code" value="{{ old('email') }}">
                                </p>
                                @if (session('thongbao'))
                                    <div class="alert alert-danger">
                                        {!!session('thongbao')!!}
                                    </div>
                                @endif
                                <p>
                                    <input type="password" class="form-control" id="inputEmailAddress" placeholder="Nhập mật khẩu mới"
                                        name="password" value="{{ old('password') }}">
                                </p>
                                <input type="hidden" name="name" value="{{$code}}">
                                <input type="hidden" name="id_user" value="{{$id_user}}">
                                <button class="button" type="submit">Đặt lại lại mật khẩu</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        @media screen and (min-width: 768px) {
            .main {
                margin-left: 40%;
            }
        }

    </style>

@endsection
