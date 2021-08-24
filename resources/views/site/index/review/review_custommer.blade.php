<div class="block-paralax4" style="background-image: url('../review/bg-19.jpg')">
    <div class="container">
        <div class="head">
            <h3 class="title" style="font-family: sans-serif">PHẢN HỒI</h3>
            <span class="sub-title" style="font-family: sans-serif">Khách hàng & Đối tác nói về chúng tôi!</span>
        </div>
        <div class="row">
            <div class="col-lg-offset-2 col-sm-12 col-lg-8">
                <div class="testimonials style2 owl-carousel nav-style2 nav-center-center" data-autoplay="true"
                    data-items="1" data-nav="true" data-dots="false">
                    @foreach ($users_review as $item)
                        <div class="testimonial">
                            <div class="avatar">
                                <img src="../users/{{ $item->image }}" alt="{{ $item->name }}" />
                            </div>
                            <div class="inner">

                                <p class="text-in"style="font-family: sans-serif">{{ substr($item->review, 0, 50) }}...</p>
                                <h6 style="font-family: sans-serif">{{ $item->name }}</h6>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
<style>
      blockquote:before{

      background-image:url('../review/blockquote-left.png');
  }
  blockquote:after{
      background-image:url('../review/blockquote-right.png');
  }
  .testimonials.style2 .text-in:before {
      background-image: url('../review/t-left.png');
  }
  .testimonials.style2 .text-in:after {
      background-image: url('../review/t-right.png');
  }
</style>