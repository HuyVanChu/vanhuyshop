@extends('site.index.master.layout')
@section('title')
    Nội dung {{$blog->title}}
@endsection
@section('active_blog')
class=" active menu-item-has-children"
@endsection
@section('main')
<div class="main-container">
    <div class="container">
        <div class="blog-detail">
            <article class="blog-item">
                <h2 class="blog-title">{{$blog->title}}</h2>
                <div class="entry-meta">
                    <span class="post-date">{{ date('d-m-Y h:i:s', strtotime($blog->created_at)) }}</span>
                    <span class="blog-comment"><i class="fa fa-comment"></i><span class="count-comment">{{$blog->commentBlog->count()}}</span></span>
                </div>
                <div class="blog-short-desc">
                    {!!$blog->body!!}
                </div>
            </article>
        </div>
        <div class="comment-social">
              <h4>{{$blog->commentBlog->count()}} Bình luận</h4>
        </div>
        <div id="comments">
            <h4 class="comment-list-title">{{$blog->commentBlog->count()}} Bình luận</h4>
            <ul class="comment-list">
                @foreach ($blog->commentBlog as $item)
                @if ($item->parent==0)
                <li class="comment even parent">
                    <div class="comment-item">
                        <div class="comment-author">
                            <img style=" border-radius: 50%;" alt="{{$item->User->name}}" src="../users/{{ $item->User->image }}" width="960" height="80">
                        </div>
                        <div class="comment-body">
                            <h5 class="author">{{$item->User->name}}</h5>
                                <span class="date-comment">{{ date('d-m-Y', strtotime($item->created_at)) }}</span>
                            <div class="comment-content">
                                 <p>{{$item->comnent}}</p>
                            </div>
                        </div>
                    </div>
                </li>
                @endif
                @foreach ($blog->commentBlog as $value)
                @if ($value->parent==$item->id)
                <li class="comment even parent">
                    <div class="comment-item">
                        <div class="comment-author">
                            <img style=" border-radius: 50%;" alt="{{$value->user_admin->name}}" src="../users/{{ $value->user_admin->image }}" width="960" height="80">
                        </div>
                        <div class="comment-body">
                            <h5 class="author">{{$value->user_admin->name}}</h5>
                                <span class="date-comment">{{ date('d-m-Y', strtotime($value->created_at)) }}</span>
                            <div class="comment-content">
                                 <p>{{$value->comnent}}</p>
                            </div>
                        </div>
                    </div>
                </li>
                @endif
                @endforeach
                @endforeach

            </ul>
            <div class="comment-form">
                <h3 class="comment-reply-title">ĐỂ LẠI NHẬN XÉT</h3>
                @if (Auth::guard('guest')->check())
                <form method="post" action="{{route('AddCommentBLog',['id'=>$blog->id])}}">
                    @csrf
                    <textarea class="comment-form-comment" name="comment" cols="45" placeholder="Viết bình luận" rows="8" aria-required="true"></textarea>
                       <div class="clear"></div>
                    <input type="submit" name="button" class="submit style2" value="Bình luận">
                    <input class="button" type="hidden" name="comment_parent" id="comment_parent" value="0">
                </form>
                @else
                <a href="{{route('sigin_site')}}">Trước khi bình luận, hãy đăng nhập</a>
                @endif
            </div>
        </div>
        <div class="related-wrap">
            <h4 class="related-title"> CÓ THỂ BẠN CŨNG THÍCH</h4>
             <ul class="blog-related row">
                 @foreach ($blog_take as $item)
                 <li class="blog-item col-sm-4">
                    <div class="post-thumbnail">
                        <a class="banner-opacity" href="{{ route('contentblog', ['slug' => $item->slug]) }}"><img alt="{{$blog->title}}" src="../blogs/{{ $item->image }}"  width="960" height="280"></a>
                    </div>
                    <h3 class="blog-title"><a href="{{ route('contentblog', ['slug' => $item->slug]) }}">{{ substr($item->title, 0, 50)  }}...</a></h3>
                    <div class="entry-meta">
                        <span class="post-date">{{ date('d-m-Y', strtotime($blog->datetime)) }}</span>
                        <span class="blog-comment"><i class="fa fa-comment"></i><span class="count-comment">{{ $item->commentBlog->count() }}</span></span>
                    </div>
                </li>
                 @endforeach

            </ul>
        </div>

      </div>
</div>
@endsection
