@extends('site.index.master.layout')
@section('title')
    Giỏ hàng
@endsection
@section('main')
    <div class="main-container no-sidebar">
        <div class="container">
            <div class="main-content">
                <div class="page-title">
                    <h3>Giỏ hàng của bạn</h3>
                </div>
                @if (session('thong-bao-loi'))
                {!!session('thong-bao-loi')!!}
                @endif
                @if (Cart::Content()->count() > 0)
                    <div class="row">
                        <div class="col-sm-12 col-md-8">

                                 <table class="shop_table cart">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="product-price">Ảnh</th>
                                        <th class="product-name">Sản phẩm</th>
                                        <th class="product-price">Giá</th>
                                        <th class="product-quantity">Số lượng</th>
                                        <th class="product-subtotal">Tổng tiền</th>
                                        <th class="product-remove">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (Cart::Content() as $item)
                                        <tr>
                                            <td colspan="2" class="product-thumbnail"><img
                                                    src="../product/{{ $item->options->img }}" alt=""></td>
                                            <td>{{ $item->name }}
                                                @if ($item->options->attr != null)
                                                    @foreach ($item->options->attr as $key => $value)
                                                        <div>{{ $key }}: {{ $value }}</div>
                                                    @endforeach
                                                @endif
                                            </td>

                                            <td><a href="#">{{ number_format($item->price, 0, '', ',') }} VND</a></td>
                                            <td class="product-quantity">
                                                 <form method="post">
                                                @csrf
                                                <input onchange="update_qty('{{ $item->rowId }}',this.value)"
                                                    type="number" id="quantity" name="quantity"
                                                    class="form-control input-number text-center"
                                                    value="{{ $item->qty }}">
                                                <input style="visibility: visible;" type="hidden" name="rowId" value="{{$item->rowId}}">
                                                <button style="visibility: hidden;" type="submit" name="submit{{$item->rowId}}"></button>
                                                </form>
                                            </td>
                                            <td>{{ number_format($item->price * $item->qty, 0, '', ',') }}VND</td>
                                            <td class="product-remove"><a onclick="return del_cart('{{ $item->name }}')"
                                                    href="{{ route('removecart', ['id' => $item->rowId]) }}"><i
                                                        class="fa fa-close"></i></a></td>

                                        </tr>
                                    @endforeach


                                </tbody>

                            </table>

                            <div class="box-coupon">
                                <div class="coupon">
                                    <h3 class="coupon-box-title">Mã giảm giá</h3>
                                    <div class="inner-box">
                                        <form action="{{route('discountcode')}}" method="post">
                                            @csrf
                                            <input type="text" name="discode" class="input-text" id="coupon_code"
                                                placeholder="Nhập mã giảm giá">
                                            <input type="submit" class="button" name="apply_coupon" value="Áp dụng">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="box-cart-total">
                                <h2 class="title">TỔNG GIỎ HÀNG</h2>
                                <table>
                                    <tr>
                                        <td>Phí vận chuyển: 40.000 VNĐ</td>
                                    </tr>
                                    <tr class="order-total">
                                        <td>Tổng tiền</td>
                                        <td>{{ number_format(str_replace(',', '', Cart::subtotal()) + 40000, 0, '', ',') }}
                                            VNĐ</td>
                                    </tr>
                                </table>
                                <a href="{{ route('checkOut') }}" class="button btn-primary medium checkout-button"
                                    type="button">Tiếp</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script>
        function del_cart(name) {
            return confirm('Bạn muốn xóa khỏi giỏ hàng: ' + name + ' ?');
        }
        function update_qty(rowId, qty) {
            $.get('/updatecart/' + rowId + '/' + qty,
                function() {
                    window.location.reload();
                }
            );
        }

    </script>
@endsection
