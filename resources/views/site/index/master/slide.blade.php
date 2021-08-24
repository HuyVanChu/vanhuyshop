<div class="home-slide5 slide-fullscreen owl-carousel nav-style4 nav-center-center" data-animateout="fadeOut" data-animatein="fadeIn" data-items="1" data-nav="true" data-dots="false" data-loop="true" data-autoplay="true">
    @foreach ($banners as $item)
    <div class="item-slide full-height" data-background="../slides/{{$item->image}}"></div>
    @endforeach
</div>
