@extends('site.index.master.layout')
@section('title')
    Phản hồi
@endsection
@section('main')
<div class="main-container">

    <div class="container">
        <div id="comments">
            <div class="comment-form">
                {!!alert_success(session('thong-bao'))!!}
                <h3 class="comment-reply-title">ĐỂ LẠI PHẢN HỒI</h3>
                @if (Auth::guard('guest')->check())
                <form method="post">
                    @csrf
                    <textarea class="comment-form-comment" name="comment" cols="45" placeholder="Viết phản hồi" rows="8" aria-required="true"></textarea>
                       <div class="clear"></div>
                    <input type="submit" name="button" class="submit style2" value="Gửi phản hồi">
                    <input class="button" type="hidden" name="comment_parent" id="comment_parent" value="0">
                </form>
                @else
                <a href="{{route('sigin_site')}}">Trước khi phản hồi, hãy đăng nhập</a>
                @endif
            </div>
        </div>

      </div>
</div>
@endsection
