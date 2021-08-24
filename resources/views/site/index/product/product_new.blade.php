<div class="margin-top-70">
    <div class="container">
        <div class="section-title style8 text-center margin-bottom-40">
            <!--<h3>SẢN PHẨM MỚI</h3>-->
               <h3 style="color: rgba(12, 12, 12, 0.842)">SẢN PHẨM MỚI</h3>
        </div>
        <ul class="lines-space-60 desktop-columns-3 tablet-columns-2 mobile-columns-1 row owl-carousel-mobile" data-nav="false" data-dots="false" data-margin="0" data-loop="true" data-items="1">
            @foreach ($product_new as $item)
            <li class="product-item style8 mobile-slide-item col-sm-6 col-md-4">
                <div class="product-inner">
                    <div class="product-thumb has-back-image">
                        <a href="{{route('productDetail',['slug'=>$item->slug])}}"><img src="../product/{{$item->image}}" alt="{{$item->name}}" width="960" height="450"></a>
                        <a class="back-image" href="{{route('productDetail',['slug'=>$item->slug])}}"><img src="../product/{{$item->image2}}" alt="{{$item->name}}" width="960" height="450"></a>

                        <div class="add-cart-wapper">
                            <a href="{{route('addcartshop',['slug'=>$item->slug])}}" class="button add_to_cart_button">Thêm giỏ hàng</a>
                        </div>
                    </div>
                    <div class="product-info" >
                        <h3 class="product-name" style="color: rgba(12, 12, 12, 0.842)"><a href="{{route('productDetail',['slug'=>$item->slug])}}">{{$item->name}}</a></h3>
                        <span class="price" style="font-family: sans-serif">
                            <ins>{{number_format($item->price)}} VNĐ</ins>
                        </span>

                    </div>
                </div>
            </li>
            @endforeach

        </ul>
        <a href="{{route('shop')}}" class="button-loadmore">XEM NHIỀU HƠN</a>


    </div>
</div>
