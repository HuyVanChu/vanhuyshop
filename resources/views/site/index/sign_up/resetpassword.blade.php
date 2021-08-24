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
                            @if (session('thong-bao'))
                            <div class="alert alert-success">
                                {!!session('thong-bao')!!}
                            </div>
                            @endif
                            <form class="row g-3" action="{{route('resetpasswordpost')}}" method="POST">
                                @csrf
                                <p>
                                    <input type="email" class="form-control" id="inputEmailAddress" placeholder="Nhập email"
                                        name="email" value="{{ old('email') }}">
                                </p>
                                @if (session('thongbao'))
                                    <div class="alert alert-danger">
                                        {!!session('thongbao')!!}
                                    </div>
                                @endif

                                @if ($errors->any())
                                <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                        {{ $error }}
                                        @endforeach
                                </div>
                                @endif
                                {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display() !!}
                                
                                <br>
                                <button class="button" type="submit">Lấy lại mật khẩu</button>
                            </form>
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
