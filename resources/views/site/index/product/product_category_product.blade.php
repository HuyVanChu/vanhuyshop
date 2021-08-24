@extends('site.index.master.layout')
@section('title')
    Danh mục {{$category->name}}
@endsection
@section('active_product')
class="active menu-item-has-children item-megamenu"
@endsection
@section('main')
<div class="main-container left-slidebar">
	<div class="container">
		<div class="row">
			<div class="main-content col-sm-8 col-md-9">
				<ul class="product-list-grid desktop-columns-3 tablet-columns-2 mobile-columns-1 row">
					@foreach ($category_product as $product)
                    <li class="product-item col-sm-6 col-md-4">
						<div class="product-inner">
							<div class="product-thumb has-back-image">
								<a href="{{route('productDetail',['slug'=>$product->slug])}}"><img src="../product/{{$product->image}}" alt="{{$product->name}}" width="900" height="280"></a>
								<a class="back-image" href="{{route('productDetail',['slug'=>$product->slug])}}"><img src="../product/{{$product->image2}}" alt="{{$product->name}}" width="900" height="280"></a>
							</div>
							<div class="product-info">
								<h3 class="product-name"><a href="{{route('productDetail',['slug'=>$product->slug])}}">{{$product->name}}</a></h3>
								<span class="price">
									<ins>{{ number_format($product->price)}} VNĐ</ins>
								</span>
								<a href="{{route('addcartshop',['slug'=>$product->slug])}}" class="button">Thêm vào giỏ hàng</a>
							</div>
						</div>
					</li>
                    @endforeach
				</ul>
				{{$category_product->links()}}
			</div>
			<div class="col-sm-4 col-md-3 sidebar">
                    <div class="widget widget_product_categories">
                        <h2 class="widget-title">DANH MỤC</h2>
                        <ul class="product-categories">
                            @foreach ($categories as $item)
                            <li><a href="{{route('catshop',['slug_cat'=>$item->slug])}}">{{$item->name}} <span class="count">({{$item->products->count()}})</span></a></li>
                            @endforeach
                        </ul>
                    </div>
                    @foreach ($attribute as $item_attribute)
                    <div class="widget widget_layered_nav">
                        <h2 class="widget-title">{{$item_attribute->name}}</h2>
                        <ul class="product-categories">
                            @foreach ($item_attribute->values as $item)
                            <li><a href="{{route('catvalueattr',['valueattribute'=>$item->value,'slug_cat'=>$slug_cat])}}">{{$item->value}}<span class="count">(20)</span></a></li>
                            @endforeach

                        </ul>
                    </div>
                    @endforeach
            </div>
		</div>
	</div>
</div>
@endsection
