<div class="section-slide-group-product" >
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <div class="section-title style9 text-left margin-top-80 margin-bottom-30">
                    <h3 style="color: rgba(12, 12, 12, 0.842)">Nổi bật</h3>
                </div>
                <ul class="owl-carousel nav-top-right nav-style8 owl-custom-nav-postion" data-autoplay="false" data-navigation="true" data-margin="30" data-slidespeed="500" data-autoheight="false" data-nav="true" data-dots="false" data-loop="true" data-autoplaytimeout="1000" data-autoplayhoverpause="true" data-responsive='{"0":{"items":"1"},"768":{"items":"2"},"992":{"items":"1"}}' data-navigation_margin="58">
                    @foreach ($product_featured as $item)
                    <li class="product-item style8">
                        <div class="product-inner">
                            <div class="product-thumb has-back-image">
                                <a href="{{route('productDetail',['slug'=>$item->slug])}}"><img src="../product/{{$item->image}}" alt="" width="960" height="470"></a>
                                <a class="back-image" href="{{route('productDetail',['slug'=>$item->slug])}}"><img src="../product/{{$item->image2}}" alt="" width="960" height="470"></a>

                                <div class="add-cart-wapper">
                                    <a href="{{route('addcartshop',['slug'=>$item->slug])}}" class="button add_to_cart_button">Thêm giỏ hàng</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <h3 class="product-name"><a href="{{route('productDetail',['slug'=>$item->slug])}}">{{$item->name}}</a></h3>
                                <span class="price" style="font-family: sans-serif">
                                    <ins>{{number_format($item->price)}} VNĐ</ins>
                                </span>

                            </div>
                        </div>
                    </li>
                    @endforeach

                </ul>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="section-title style9 text-left margin-top-80 margin-bottom-30">
                    <h3 style="color: rgba(12, 12, 12, 0.842)">Bán chạy</h3>
                </div>
                <ul class="owl-carousel nav-top-right nav-style8 owl-custom-nav-postion" data-autoplay="false" data-navigation="true" data-margin="30" data-slidespeed="500" data-autoheight="false" data-nav="true" data-dots="false" data-loop="true" data-autoplaytimeout="1000" data-autoplayhoverpause="true" data-responsive='{"0":{"items":"1"},"768":{"items":"2"},"992":{"items":"1"}}' data-navigation_margin="58">
                    @foreach ($product_new as $item)
                    <li class="product-item style8">
                        <div class="product-inner">
                            <div class="product-thumb has-back-image">
                                <a href="{{route('productDetail',['slug'=>$item->slug])}}"><img src="../product/{{$item->image}}" alt="" width="960" height="470"></a>
                                <a class="back-image" href="{{route('productDetail',['slug'=>$item->slug])}}"><img src="../product/{{$item->image2}}" alt="" width="960" height="470"></a>

                                <div class="add-cart-wapper">
                                    <a href="{{route('addcartshop',['slug'=>$item->slug])}}" class="button add_to_cart_button">Thêm giỏ hàng</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <h3 class="product-name"><a href="{{route('productDetail',['slug'=>$item->slug])}}">{{$item->name}}</a></h3>
                                <span class="price"style="font-family: sans-serif">
                                    <ins>{{number_format($item->price)}} VNĐ</ins>
                                </span>

                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="section-title style9 text-left margin-top-80 margin-bottom-30">
                    <h3 style="color: rgba(12, 12, 12, 0.842)">Giảm giá</h3>
                </div>
                <ul class="owl-carousel nav-top-right nav-style8 owl-custom-nav-postion" data-autoplay="false" data-navigation="true" data-margin="30" data-slidespeed="500" data-autoheight="false" data-nav="true" data-dots="false" data-loop="true" data-autoplaytimeout="1000" data-autoplayhoverpause="true" data-responsive='{"0":{"items":"1"},"768":{"items":"2"},"992":{"items":"1"}}' data-navigation_margin="58">
                    @foreach ($product_new as $item)
                    <li class="product-item style8">
                        <div class="product-inner">
                            <div class="product-thumb has-back-image">
                                <a href="{{route('productDetail',['slug'=>$item->slug])}}"><img src="../product/{{$item->image}}" alt="" width="960" height="470"></a>
                                <a class="back-image" href="{{route('productDetail',['slug'=>$item->slug])}}"><img src="../product/{{$item->image2}}" alt="" width="960" height="470"></a>

                                <div class="add-cart-wapper">
                                    <a href="{{route('addcartshop',['slug'=>$item->slug])}}" class="button add_to_cart_button">Thêm giỏ hàng</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <h3 class="product-name" style="font-family: sans-serif"><a href="{{route('productDetail',['slug'=>$item->slug])}}">{{$item->name}}</a></h3>
                                <span class="price" style="font-family: sans-serif">
                                    <ins>{{number_format($item->price)}} VNĐ</ins>
                                </span>

                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
</div>
