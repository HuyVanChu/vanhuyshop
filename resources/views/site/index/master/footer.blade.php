<footer class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row flex-flow">
                <div class="col-sm-12 col-md-4 footer-sidebar">
                    <div class="widget contact-info">
                        <span class="text-primary PlayfairDisplay">
                            {{$footer->title}}</span>
                        <h3 class="widget-title">{{$footer->content}}</h3>
                        <div class="content">
                            @foreach ($footer->footer_detail as $item)
                            <p>{!!$item->content!!}</p>
                            @endforeach
                        </div>

                    </div>
                </div>
                <div class="col-sm-12 col-md-4 footer-sidebar">
                    <div class="widget our-service">
                        <span class="text-primary PlayfairDisplay">{{$footer_2->title}}</span>
                        <h3 class="widget-title">{{$footer_2->content}}</h3>
                        <div class="content">
                            <ul>
                                <li><a href="{{route('contact')}}">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 footer-sidebar">
                    <div class="widget widget_social">
                        <span class="text-primary PlayfairDisplay">{{$footer_3->title}}</span>
                        <h3 class="widget-title">{{$footer_3->content}}</h3>
                        <div class="content">
                            <div class="social">
                                <a href="https://www.youtube.com/"><i class="fa fa-facebook"></i></a>
                                <a ><i class="fa fa-instagram"></i></a>
                                <a ><i class="fa fa-youtube-play"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

