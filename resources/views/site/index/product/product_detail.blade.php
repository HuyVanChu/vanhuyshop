@extends('site.index.master.layout')
@section('title')
    Chi tiết sản phẩm {{ $product->name }}
@endsection
@section('main')

    <div class="container">
        <div class="breadcrumbs style2">
            <a href="#">Trang chủ</a>
            <span>{{ $product->name }}</span>
        </div>
        <div class="row">
            <div class="main-content col-sm-12">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="product-detail-image style2">
                            <div class="main-image-wapper">
                                <img class="main-image" src="../product/{{ $product->image }}"
                                    alt="{{ $product->name }}" width="960" height="450">
                            </div>
                            <div class="thumbnails owl-carousel nav-center-center nav-style3"
                                data-responsive='{"0":{"items":3},"481":{"items":4},"600":{"items":3},"1000":{"items":4}}'
                                data-autoplay="true" data-loop="true" data-items="4" data-dots="false" data-nav="true"
                                data-margin="20">
                                <a data-url="../product/{{ $product->image }}" class="active" href="#"><img
                                        src="../product/{{ $product->image }}" alt="{{ $product->name }}"></a>
                                <a data-url="../product/{{ $product->image2 }}" href="#"><img
                                        src="../product/{{ $product->image2 }}" alt=""></a>
                                @foreach ($product->productdetail as $item)
                                    <a data-url="../product/product_detail/{{ $item->image }}" href="#"><img
                                            src="../product/product_detail/{{ $item->image }}" alt=""></a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('showprice', ['slug' => $product->slug]) }}" method="get">
                        @csrf
                        <div class="col-sm-8">
                            <div class="product-details-right style2">
                                <h3 class="product-name" style="font-family: sans-serif">{{ $product->name }}</h3>
                                @if ($product->comment->count() > 0)
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <span class="count-review">( {{ number_format($product->comment->count()) }}
                                            <span style="font-family: sans-serif">đánh giá</span> )</span>
                                    </div>
                                @else
                                    <div class="rating">
                                        <span style="font-family: sans-serif" class="count-review">Chưa có đánh giá</span>
                                    </div>
                                @endif
                                <span class="price" style="font-family: sans-serif">
                                    <ins>
                                        @if (isset($price))
                                            {{ number_format($price) }} VNĐ
                                        @else
                                            {{ number_format($product->price) }} VNĐ
                                            (Giá chung)
                                        @endif
                                    </ins>
                                </span>
                                <div class="meta">
                                    <span>Danh mục: <span class="text-primary"
                                            style="font-family: sans-serif">{{ $product->Categories->name }}</span></span>
                                </div>
                                <div class="short-descript">
                                    {!! $product->info !!}
                                </div>
                                @foreach (attr_values($product->values) as $key => $value)
                                    <div class="size-wrap" style="font-family: sans-serif">
                                        <p class="size-desc">
                                            {{ $key }}:
                                            @foreach ($value as $item)
                                                <a class="size">{{ $item }}</a>
                                            @endforeach
                                        </p>
                                    </div>
                                @endforeach
                                @if (session('thong-bao-loi'))
                                    <div class="alert alert-danger">
                                        {!! session('thong-bao-loi') !!}
                                    </div>
                                @endif
                                @if ($product->values->count() > 0)
                                    <div class="size-wrap">
                                        <p class="size-desc"  style="font-family: sans-serif">
                                            <label>LỰA Chọn</label>
                                        </p>
                                    </div>
                                @endif

                                <div class="row">
                                    @foreach (attr_values($product->values) as $key => $value)
                                        <div class="col-md-3">
                                            <div class="form-group" style="font-family: sans-serif">
                                                <label>{{ $key }}:</label>
                                                <select class="form-control" name="attr[{{ $key }}]">
                                                    <option value="" name="value_choose">--Chọn--</option>
                                                    @foreach ($value as $item)
                                                        <option>
                                                            <p class="size-desc">{{ $item }}</p>
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="size-wrap">
                                    <p class="size-desc" style="font-family: sans-serif">
                                        <label>Số lượng:</label>
                                    </p>
                                </div>
                                <div class="quantity">
                                    <input type="number" min="1" step="1" value="1" name="quantity">
                                </div>
                                <input type="hidden" name="id_product" value="{{ $product->id }}">


                                <button type="submit" class="button button-add-cart" value="login" name="login">Thêm vào giỏ
                                    hàng</button>
                                @if ($product->values->count() > 0)
                                    <button type="submit" name="register" value="1" class="button button-add-cart">Xem lại
                                        giá</button>
                                    {{-- <input type="submit" name="register" value="Xem lại giá" class="button button-add-cart"> --}}
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- tab -->

    <div class="container">
        <div class="tab-details-product style2">
            <ul class="box-tabs nav-tab">
                <li class="active"><a data-toggle="tab" href="#tab-1">MIÊU TẢ</a></li>
                <li><a data-toggle="tab" href="#tab-2">THÔNG TIN THÊM</a></li>
            </ul>
            <div class="tab-container">
                <div id="tab-1" class="tab-panel active">
                    {!! $product->describer !!}
                </div>
                <div id="tab-2" class="tab-panel">
                    @foreach ($product->value_column as $item)
                        <div class="mb-3">
                            <label for="inputProductTitle" class="form-label">{{ $item->column->column }}: </label>
                            <input type="text" name="name" class="form-control" id="inputProductTitle"
                                placeholder="Bắt buộc" value="{{ $item->value }}" disabled>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <div style="border-top: 0px;margin-top: -50px" class="box-list-reviews">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="box-review">
                            <h4 class="title-border"><span class="text">PHẢN HỒI KHÁCH HÀNG</span><span class="subtext">(
                                    {{ number_format($product->comment->count()) }} nhận xét )</span></h4>
                            <ol class="commentlist">
                                @foreach ($product->comment as $item)
                                    @if ($item->parent == 0)
                                        <li class="comment">
                                            <div class="comment_container">
                                                <div class="comment-info">
                                                    <div class="meta">
                                                        @if ($item->use_id == null)
                                                            <span class="author">Amin:
                                                                {{ $item->user_admin->name }}</span>
                                                            <span class="author">Trả lời:
                                                                {{ $item->name_user_comment }}</span>
                                                            <span
                                                                class="date">{{ date('d-m-Y', strtotime($item->created_at)) }}</span>
                                                        @else
                                                            <span class="author">{{ $item->users->name }}</span>
                                                            <span
                                                                class="date">{{ date('d-m-Y', strtotime($item->created_at)) }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="comment-text">
                                                    <div class="comment-content">
                                                        {{ $item->comment }}
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                    @foreach ($product->comment as $value)
                                        @if ($value->parent == $item->id)
                                            <li class="comment">
                                                <div class="comment_container">
                                                    <div class="comment-info">
                                                        <div class="meta">
                                                            @if ($value->use_id == null)
                                                                <span class="author">Amin:
                                                                    {{ $value->user_admin->name }}</span>
                                                                <span class="author">Trả lời:
                                                                    {{ $value->name_user_comment }}</span>
                                                                <span
                                                                    class="date">{{ date('d-m-Y', strtotime($value->created_at)) }}</span>
                                                            @else
                                                                <span class="author">{{ $value->users->name }}</span>
                                                                <span
                                                                    class="date">{{ date('d-m-Y', strtotime($value->created_at)) }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="comment-text">
                                                        <div class="comment-content">
                                                            {{ $value->comment }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                @endforeach

                            </ol>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="box-review form-review">
                            @if ($errors->has('name'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <h4 class="title-border"><span class="text">BÌNH LUẬN</span></h4>
                            @if (Auth::guard('guest')->check())
                                <form class="reviews" action="{{ route('addcmtprd', ['slug' => $product->slug]) }}"
                                    method="POST">
                                    @csrf
                                    <p>
                                        <textarea cols="40" placeholder="Đánh giá của bạn" name="name"></textarea>
                                    </p>
                                    <input type="hidden" value="{{ $product->id }}" name="product_id">
                                    <input type="submit" class="button submit" value="THÊM BÌNH LUẬN">
                                </form>
                            @else
                                <a href="{{ route('sigin_site') }}">Có vẻ bạn chưa đăng nhập, hãy đăng nhập và thử lại!</a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-slide upsell-products">
            <div class="section-title text-center">
                <h3>SẢN PHẨM Mới</h3>
            </div>
            <ul class="owl-carousel" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'
                data-autoplay="true" data-loop="true" data-items="4" data-dots="false" data-nav="false" data-margin="30">
                @foreach ($product_new as $item)
                    <li class="product-item">
                        <div class="product-inner">
                            <div class="product-thumb">
                                <a href="{{ route('productDetail', ['slug' => $item->slug]) }}"><img
                                        src="../product/{{ $item->image }}" alt="{{ $item->name }}" width="250"
                                        height="380"></a>
                            </div>
                            <div class="product-info">
                                <h3 class="product-name"><a
                                        href="{{ route('productDetail', ['slug' => $item->slug]) }}">{{ $item->name }}</a>
                                </h3>
                                <span class="price">
                                    <ins>{{ number_format($item->price) }}</ins>
                                </span>

                            </div>
                        </div>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>
    <style>
        .size-wrap {
            margin-bottom: 20px;
            position: relative;
        }

        .size-wrap p.size-desc {
            margin-bottom: 0;
            text-transform: uppercase;
            display: block;
            font-weight: 500;
        }

        .size-wrap p.size-desc .size {
            font-size: 12px;
            text-align: center;
            width: 36px;
            padding: 5px 0;
            display: inline-block;
            border: 1px solid #e6e6e6;
            margin-bottom: 3px;
            text-transform: uppercase;
            color: gray;
        }

        .size-wrap p.size-desc .size:hover {
            color: #FFC300;
        }

        .quantity-left-minus {
            border: 1px solid #e6e6e6;
            padding: 10px;
        }

    </style>
@endsection
