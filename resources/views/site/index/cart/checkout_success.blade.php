@extends('site.index.master.layout')
@section('title')
    Mua hàng thành công
@endsection
@section('main')
    <div class="main-container no-sidebar">
        <div class="container">
            <div class="row text-center">
                <div class="col-sm-6 col-sm-offset-3">
                <img src="../product/shop-icon-png-18.jpg">
                <h3>Gửi yêu cầu đặt hành thành công</h3>
                <p style="font-size:20px;color:#5C5C5C;">Cảm ơn bạn đã lựa chọn sản phẩm cửa hàng. Vui lòng kiểm tra thông tin đơn hàng trong email của bạn</p>
                <a href="{{route('index')}}" class="btn btn-warning" style="background:#e0d310; border:none;">Tiếp tục mua hàng</a>
            <br><br>
                </div>

            </div>
        </div>
    </div>

@endsection
