@extends('site.index.master.layout')
@section('title')
    Cửa hàng
@endsection
@section('active_product')
class="active menu-item-has-children item-megamenu"
@endsection
@section('main')
    <div class="main-container left-slidebar">
        <div class="container">
            <div class="row">
                <div class="main-content col-sm-8 col-md-9">
                    @if (isset($product_null))
                        <h5>Chưa có sản phẩm nào</h5>
                    @else
                        <ul class="product-list-grid desktop-columns-3 tablet-columns-2 mobile-columns-1 row">
                            @foreach ($products as $product)
                                <li class="product-item col-sm-6 col-md-4">
                                    <div class="product-inner">
                                        <div class="product-thumb has-back-image">
                                            <a href="{{ route('productDetail', ['slug' => $product->slug]) }}"><img
                                                    src="../product/{{ $product->image }}"
                                                    alt="{{ $product->name }}" width="500" height="370"></a>
                                            <a class="back-image"
                                                href="{{ route('productDetail', ['slug' => $product->slug]) }}"><img
                                                    src="../product/{{ $product->image2 }}"
                                                    alt="{{ $product->name }}" width="500" height="370"></a>
                                        </div>
                                        <div class="product-info">
                                            <h3 class="product-name"><a
                                                    href="{{ route('productDetail', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                                            </h3>
                                            <span class="price">
                                                <ins>{{ number_format($product->price) }} VNĐ</ins>
                                            </span>
                                            <a href="{{ route('addcartshop', ['slug' => $product->slug]) }}"
                                                class="button">Thêm
                                                vào giỏ hàng</a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        {{ $products->links() }}
                    @endif

                </div>
                <div class="col-sm-4 col-md-3 sidebar">
                    <div class="widget widget_product_categories">
                        <h2 class="widget-title">DANH MỤC</h2>
                        <ul class="product-categories">
                            @foreach ($categories as $item)
                                <li><a href="{{ route('shop', ['danhmuc' => $item->slug]) }}">{{ $item->name }} <span
                                            class="count">({{ $item->products->count() }})</span></a></li>
                            @endforeach
                        </ul>
                    </div>
                    @if (isset($attribute))
                        @foreach ($attribute as $item)
                            <div class="widget widget_layered_nav">
                                <h2 class="widget-title">{{ $item->name }}</h2>
                                <ul class="product-categories">
                                    @foreach ($item->values as $item)
                                        <li>
                                            <a
                                                href="{{ route('shop', ['danhmuc_attribute' => $category->slug, 'thuoctinh' => $item->id]) }}">
                                                {{ $item->value }}<span
                                                    class="count">({{ $item->products->count() }})</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    @endif
                    @if (isset($max))
                        <div class="widget widget_price_filter">
                            <h2 class="widget-title">Tìm theo khoảng giá</h2>
                            <form action="{{ route('shop') }}" method="get">
                                @csrf
                                <div class="price_slider_wrapper">

                                    <label for="amount">Giá từ: </label>
                                    <p>
                                        <input class="form-control" type="text" id="amount_start" name="start_price"
                                            value="{{ $min }}">
                                        <input class="form-control" type="text" id="amount_end" name="end_price"
                                            value="{{ $max }}">
                                    </p>
                                    <div id="slider-range"></div><br>
                                    <input type="hidden" value="{{ $category->id }}" name="danhmuc_submit_price">
                                    <input type="submit" data-inline="true" value="Tìm" name="submit_price">
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if (isset($min))
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $(function() {
                $("#slider-range").slider({
                    range: true,
                    min: {{ $min }},
                    max: {{ $max }},
                    values: [{{ $min }}, {{ $max }}],
                    slide: function(event, ui) {
                        $("#amount_start").val(ui.values[0]);
                        $("#amount_end").val(ui.values[1]);
                    }
                });
            });

        </script>
    @endif

@endsection
