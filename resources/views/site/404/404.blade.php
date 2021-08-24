@extends('site.index.master.layout')
@section('title')
Trang không tồn tại site
@endsection
@section('main')
<div class="container">
    <div class="text-center page-404">
        <h1 class="heading">404</h1>
        <h2 class="title">Ồ... Trang Không Tồn Tại</h2>
        <p>Xin lỗi, nhưng không tìm thấy trang bạn đang tìm. Hãy đảm bảo rằng bạn đã nhập URL.</p>
        <a class="button" href="{{route('index')}}">Trở về trang chủ</a>
    </div>
</div>
@endsection

