@extends('site.index.master.layout')
@section('title')
    Thanh toán
@endsection
@section('main')
    <div class="main-container no-sidebar">
        <div class="container">
            <div class="main-content">
                @if (Cart::Content()->count() > 0)
                    <div class="page-title">
                        <h3>THỦ TỤC THANH TOÁN</h3>
                    </div>
                    <div class="row">
                        <h5 class="form-title">NHẬP THÔNG TIN CỦA BẠN</h5>
                        <form action="{{route('checkoutsuccess')}}" method="post">
                            @csrf
                            <div class="col-sm-6">
                                <div class="form-checkout">
                                    <p><input type="text" placeholder="Nhập tên" name="name" value="{{ old('name') }}">
                                    </p>
                                    @if ($errors->has('name'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                    <p><input type="text" placeholder="Nhập số điện thoại" name="phone"
                                            value="{{ old('phone') }}"></p>
                                    @if ($errors->has('phone'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('phone') }}
                                        </div>
                                    @endif
                                    <p><input type="text" placeholder="Nhập email" name="email"
                                            value="{{ old('email') }}">
                                    </p>
                                    @if ($errors->has('email'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                    <p><input type="text" placeholder="Nhập địa chỉ" name="address"
                                            value="{{ old('address') }}"></p>
                                    @if ($errors->has('address'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('address') }}
                                        </div>
                                    @endif
                                    <p>Yêu cầu thêm:</p>
                                    <textarea class="form-control" id="inputProductDescription" rows="3"
                                        name="note"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-checkout order">
                                    <table class="shop-table order">
                                        <thead>
                                            <tr>
                                                <th class="product-name">SẢN PHẨM</th>
                                                <th class="total">TỔNG</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cart as $item)
                                                <tr>
                                                    <td class="product-name"><img
                                                            src="../product/{{ $item->options->img }}" alt=""
                                                            name="image" width="50" height="50"> {{ $item->name }} x
                                                        {{ $item->qty }}
                                                        @if ($item->options->attr != null)
                                                            @foreach ($item->options->attr as $key => $value)
                                                                | {{ $key }} : {{ $value }}
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    <td class="total">
                                                        <span
                                                            class="price">{{ number_format($total, 0, '', ',') }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td class="subtotal">Phiếu giảm giá</td>
                                                <td class="total">0%</td>
                                            </tr>
                                            <tr class="order-total">
                                                <td class="subtotal">TỔNG ĐƠN HÀNG</td>
                                                <td class="total"><span
                                                        class="price">{{ number_format($total, 0, '', ',') }}
                                                        VNĐ</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button class="button btn-primary medium" type="submit">Đặt Hàng</button>
                                </div>
                            </div>
                        </form>

                    </div>
                @else
                    <div class="page-title">
                        <h3>BẠN CHƯA CÓ SẢN PHẢM NÀO TRONG GIỎ HÀNG, HÃY TIẾP TỤC MUA SẮM VÀ THỬ LẠI</h3>
                    </div>
                @endif

            </div>
        </div>

    </div>
@endsection
