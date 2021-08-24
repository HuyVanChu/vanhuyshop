@extends('site.index.master.layout')
@section('title')
    Trang chủ
@endsection
@section('active')
class="active menu-item-has-children item-megamenu"
@endsection
@section('main')
@include('site.index.master.banner')
@include('site.index.product.product_new')
@include('site.index.review.review_custommer')
@include('site.index.product.product_feature_onsale')
@include('site.index.slogan.slogan')
<div class="margin-top-70">
    <div class="container">
        @include('site.index.image_trademark.image_trademark')
    </div>
</div>
@endsection


