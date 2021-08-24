<div class="row">
    <div class="col-12 col-lg-6 col-xl-4 d-flex">
        <div class="card radius-10 overflow-hidden w-100">
            <div class="card-body">
                <p>Tổng thu nhập theo tuần</p>
                <h4 class="mb-0">{{number_format($total_Week)}} VNĐ</h4>
                <small>1.4% <i class="zmdi zmdi-long-arrow-up"></i> Kể từ tháng trước</small>
                <hr>
                <p>Tổng thu nhập tháng {{$currentMonth}}</p>
                <h4 class="mb-0">{{number_format($total_Month)}} VNĐ</h4>
                <small>1.4% <i class="zmdi zmdi-long-arrow-up"></i> Kể từ tháng trước</small>
                <hr>
                <p>Tổng doanh thu theo năm {{$currentYear}}</p>
                <h4 class="mb-0">{{number_format($total_Year)}} VNĐ</h4>
                <small>5.43% <i class="zmdi zmdi-long-arrow-up"></i> Since Last Month</small>
                <div class="mt-5">
                    <div class="chart-container-4">
                        <canvas id="chart5"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-6 col-xl-8 d-flex">
        <div class="card radius-10 w-100">
            <div class="card-header border-bottom">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Đánh giá của khách hàng</h6>
                    </div>
                    <div class="font-22 ms-auto text-white"><i class="bx bx-dots-horizontal-rounded"></i>
                    </div>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($cmt_product as $item)
                <li class="list-group-item bg-transparent">
                    <div class="d-flex align-items-center">
                        <img src="../users/{{$item->users->image}}" alt="user avatar" class="rounded-circle"
                            width="55" height="55">
                        <div class="ms-3">
                            <h6 class="mb-0">{{$item->product->name}}<small class="ms-4">{{ date('d-m-Y', strtotime($item->created_at)) }}</small></h6>
                            <p class="mb-0 small-font">{{$item->users->name}} : {{$item->comment}}
                            </p>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
