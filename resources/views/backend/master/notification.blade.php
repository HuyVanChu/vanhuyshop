<li>
    <a class="has-arrow" href="javascript:;">
        <div class="parent-icon"><i class="lni lni-alarm"></i>
        </div>
        <div class="menu-title">Thông báo</div>
    </a>
    <ul>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="menu-title">Chưa xử lý</div>
            </a>
            <ul>
                <li><a href="{{route('admin_order_list')}}"><i class="bx bx-right-arrow-alt"></i>Đơn hàng</a>
                </li>
                <li> <a href="{{route('admin_cmt_product')}}"><i class="bx bx-right-arrow-alt"></i>Sản phẩm</a>
                </li>
                <li> <a href="{{route('admin.cmtblogno')}}"><i class="bx bx-right-arrow-alt"></i>Bài viết</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="menu-title">Đã xử lý</div>
            </a>
            <ul>
                <li><a href="{{route('admin_order_yes')}}"><i class="bx bx-right-arrow-alt"></i>Đơn hàng</a>
                </li>
                <li> <a href="{{route('admin_cmt_ok')}}"><i class="bx bx-right-arrow-alt"></i>Bình luận sản phẩm</a>
                </li>
                <li> <a href="{{route('admin.cmtblogyes')}}"><i class="bx bx-right-arrow-alt"></i>Bình luận bài viết</a>
                </li>
            </ul>
        </li>
    </ul>
</li>
