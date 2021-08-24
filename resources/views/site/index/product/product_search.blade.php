@extends('site.index.master.layout')
@section('title')
    Tìm kiếm
@endsection
@section('main')
<div class="main-container no-slidebar">
	<div class="container">
		<div class="row">
			<div class="main-content col-sm-12">
				<div class="shop-top">
					<div class="shop-top-left">
						<div class="breadcrumbs">
		                    <a href="{{route('index')}}">Trang chủ</a>
		                    <span>{{$name_search}}</span>
		                </div>
					</div>
					<div class="shop-top-right">
						<span class="woocommerce-result-count">Hiển thị trang {{$product->currentPage()}} - với {{$product->count()}} sản phẩm / {{$product->total()}} kết quả</span>
					</div>
				</div>
                @if ($count<0 || $count ==0)
                Chưa có sản phẩm phù hợp với từ khóa {{$name_search}}
                @else
                <ul class="product-list-grid desktop-columns-2 tablet-columns-2 mobile-columns-1 row">
                    @foreach ($product as $item)
                    <li class="product-item col-sm-6">
						<div class="product-inner">
							<div class="product-thumb has-back-image">
								<a href="{{route('productDetail',['slug'=>$item->slug])}}"><img src="../product/{{$item->image}}" alt="{{$item->name}}" width="960" height="560"></a>
                                <a class="back-image" href="{{route('productDetail',['slug'=>$item->slug])}}"><img src="../product/{{$item->image2}}" alt="{{$item->name}}" width="960" height="560"></a>
							</div>
							<div class="product-info">
								<h3 class="product-name"><a href="{{route('productDetail',['slug'=>$item->slug])}}">{{$item->name}}</a></h3>
								<span class="price">
									<ins>{{ number_format($item->price)}} VNĐ</ins>
									{{-- <del>£95.00</del> --}}
								</span>
								<a href="{{route('addcartshop',['slug'=>$item->slug])}}" class="button">THÊM GIỎ HÀNG</a>
							</div>
						</div>
					</li>
                    @endforeach
				</ul>
				<div class="navigation">
                    {{$product->links()}}
                </div>
                @endif

			</div>
		</div>
	</div>
</div>
@endsection
