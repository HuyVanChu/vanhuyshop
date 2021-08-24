@extends('site.index.master.layout')
@section('title')
Liên hệ
@endsection
@section('active')
class="active menu-item-has-children item-megamenu"
@endsection
@section('main')
<div class="container">
    <div class="row">
        <div class="col-sm-6">

            <div class="kt-contact-form margin-top-60">
                <div id="message-box-conact"></div>
                {!!$contact->title1!!}
                <p>
                    <input id="name" type="text" placeholder="Tên của bạn">
                </p>
                <p>
                    <input id="email" type="text" placeholder="Email của bạn">
                </p>
                <p>
                    <textarea id="content" placeholder="Nội dung"></textarea>
                </p>
                <button id='btn-send-contact' class="button">Gửi tin nhắn</button>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="margin-top-60">
                {!!$contact->title2!!}
                {!!$contact->title3!!}
            </div>
        </div>
    </div>
</div>
@endsection

