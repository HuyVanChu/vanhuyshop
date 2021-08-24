<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
    <div class="col">
        <div class="card radius-10 bg-primary bg-gradient">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-white">Hóa đơn chưa xử lý</p>
                        <h4 class="my-1 text-white">{{$total_order}}</h4>
                    </div>
                    <div class="text-white ms-auto font-35"><i class="bx bx-cart-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 bg-danger bg-gradient">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-white">Doanh thu theo ngày</p>
                        <h4 class="my-1 text-white">{{number_format($total_many_day)}}</h4>
                    </div>
                    <div class="text-white ms-auto font-35"><i class="bx bx-dollar"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 bg-warning bg-gradient">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-dark">Bình luận bài viết</p>
                        <h4 class="text-dark my-1">{{$total_cmt_blog}}</h4>
                    </div>
                    <div class="text-dark ms-auto font-35"><i class="bx bx-comment-detail"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 bg-success bg-gradient">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-white">Bình luận sản phẩm</p>
                        <h4 class="my-1 text-white">{{$total_cmt_product}}</h4>
                    </div>
                    <div class="text-white ms-auto font-35"><i class="bx bx-comment-detail"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
