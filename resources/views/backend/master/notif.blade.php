<li class="nav-item dropdown dropdown-large">
    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">{{$total_notif}}</span>
        <i class='bx bx-bell'></i>
    </a>
    <div class="dropdown-menu dropdown-menu-end">
        <a>
            <div class="msg-header">
                <p class="msg-header-title">Thông báo</p>
                
            </div>
        </a>
        <div class="header-notifications-list">
            @if ($total_order>0)
            <a class="dropdown-item" href="{{route('admin_order_list')}}">
                <div class="d-flex align-items-center">
                    <div class="notify"><i class="bx bx-cart-alt"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="msg-name">Đơn hàng mới <span class="msg-time float-end">2 phút trước</span></h6>
                        <p class="msg-info">Bạn có {{$total_order}} đơn đặt hàng mới</p>
                    </div>
                </div>
            </a>
            @endif
            @if ($total_cmt_product>0)
            <a class="dropdown-item" href="{{route('admin_cmt_product')}}">
                <div class="d-flex align-items-center">
                    <div class="notify"><i class="bx bx-message-detail"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="msg-name">Nhận xét sản phẩm mới <span class="msg-time float-end">4 giờ trước</span></h6>
                        <p class="msg-info">Bạn có {{$total_cmt_product}} bình luận sản phẩm mới mới</p>
                    </div>
                </div>
            </a>
            @endif
            @if ($total_cmt_blog>0)
            <a class="dropdown-item" href="javascript:;">
                <div class="d-flex align-items-center">
                    <div class="notify"><i class="bx bx-message-detail"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="msg-name">Nhận xét bài viết mới <span class="msg-time float-end">4 giờ trước</span></h6>
                        <p class="msg-info">Bạn có {{$total_cmt_blog}} bình luận bài viết mới mới</p>
                    </div>
                </div>
            </a>
            @endif

        </div>
        <a href="javascript:;">
            <div class="text-center msg-footer">Xem tất cả thông báo</div>
        </a>
    </div>
</li>
