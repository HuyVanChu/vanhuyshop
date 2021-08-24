@extends('site.index.master.layout')
@section('title')
    Danh sách bài viết
@endsection
@section('active_blog')
class=" active menu-item-has-children"
@endsection
@section('main')
    <div class="margin-top-30 section-lasttest-blog">
        <div class="section-title text-center">
            <h3>BÀI VIẾT CỦA CHÚNG TÔI</h3>
        </div>
        <div class="lastest-blog owl-carousel nav-center-center nav-style7" data-nav="true" data-dots="false"
            data-loop="true" data-margin="30" data-responsive='{"0":{"items":1},"600":{"items":1},"1000":{"items":2}}'>
            @if (isset($blogs))
            @foreach ($blogs as $item)
                <div class="item-blog">
                    <div class="left">
                        <div class="blog-date">
                            <span class="day">{{ date('d', strtotime($item->created_at)) }}</span>
                            <span class="month">/{{ date('n', strtotime($item->created_at)) }}</span><br>
                            <span class="year">{{ date('Y', strtotime($item->created_at)) }}</span>
                        </div>
                        <h3 class="blog-title"><a
                                href="{{ route('contentblog', ['slug' => $item->slug]) }}">{{ substr($item->title, 0, 50)  }}...</a></h3>
                        <div class="meta">
                            <span class="author">{{ $item->admin->name }}</span>
                            <span class="comment"><i class="fa fa-comment"></i> {{ $item->commentBlog->count() }} bình
                                luận</span>
                        </div>
                    </div>
                    <div class="right">
                        <a class="banner-border" href="{{ route('contentblog', ['slug' => $item->slug]) }}"><img
                                src="../blogs/{{ $item->image }}" alt="{{ $item->title }}" width="960"
                                height="350"></a>
                    </div>
                </div>
            @endforeach
            @endif

        </div>
        <div class="container">
            <h3 class="page-title">NHIỀU BÀI VIẾT HƠN</h3>
            <div class="blog-grid butique-masonry">
                <div class="masonry-grid" data-layoutmode="masonry" data-cols="3"
                    style="position: relative; height: 4995px;">
                    @if (isset($blogs))
                    @foreach ($blogs as $item)

                        <div class="grid-item masonry-item" style="width: 400px; position: absolute; left: 0px; top: 0px;">
                            <div class="blog-item">
                                <div class="post-thumbnail">
                                    <a class="banner-opacity" href="{{ route('contentblog', ['slug' => $item->slug]) }}"><img
                                            alt="17_blog" src="../blogs/{{ $item->image }}" width="960"
                                            height="390"></a>
                                </div>
                                <h3 class="blog-title"><a
                                        href="{{ route('contentblog', ['slug' => $item->slug]) }}">{{ substr($item->title, 0, 50)  }}...</a>
                                </h3>
                                <div class="entry-meta">
                                    <span class="post-date">{{ date('d-m-Y h:i:s', strtotime($item->created_at)) }}</span>
                                    <span class="blog-comment"><i class="fa fa-comment"></i><span
                                            class="count-comment">{{ $item->commentBlog->count() }}</span></span>
                                </div>
                                <div class="blog-short-desc">
                                    <p>{!!substr($item->info, 0, 350)!!}...</p>
                                </div>
                                <a class="readmore" href="{{ route('contentblog', ['slug' => $item->slug]) }}">XEM CHI
                                    TIẾT</a>
                            </div>
                        </div>

                    @endforeach
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
