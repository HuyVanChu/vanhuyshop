@extends('site.index.master.layout')
@section('title')
    Đăng nhập
@endsection
@section('main')
    <div class="main-container">
        <div class="container">
            <div class="row">
                <div class="main">
                    <div class="col-md-6 col-sm-12">
                        <div class="login-form">
                            <div class="text-center">
                                <h3 class="">Đăng nhập</h3>
                                <p>Bạn chưa có tài khoản<a href="{{ route('site_signup') }}"> Đăng ký tại đây</a>
                                </p>
                            </div>
                             @if (session('thongbao'))
                                    <div class="alert alert-danger">
                                        {!!session('thongbao')!!}
                                    </div>
                                    
                                @endif
                            <form class="row g-3" method="POST">
                                @csrf
                                <p>
                                    <input type="text" class="form-control" id="inputEmailAddress"
                                        placeholder="Nhập tài khoản" name="name" value="{{ old('name') }}">
                                </p>
                                @if ($errors->has('name'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                                <p>
                                    <input type="password" class="form-control border-end-0" id="inputChoosePassword"
                                        placeholder="Nhập mật khẩu" name="password" value="{{ old('password') }}">
                                </p>
                                @if ($errors->has('password'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                                <p><a style="color: #747474" href="{{ route('resetpassword') }}">Quên mật khẩu</a>
                                </p>
                                <button id="btn-send-contact" class="button" type="submit">Đăng nhập</button>
                                <a href="{{ route('site.google') }}"><button type="button" class="button">Hoặc với
                                        Google</button></a>
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
