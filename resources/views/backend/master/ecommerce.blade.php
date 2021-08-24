<li>
    <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class='bx bx-cart'></i>
        </div>
        <div class="menu-title">Cửa hàng</div>
    </a>
    <ul>
        <li> <a href="{{route('admin_trademark_list')}}"><i class="bx bx-right-arrow-alt"></i>Thương hiệu</a>
        </li>
        <li> <a href="{{route('admin_cat_list')}}"><i class="bx bx-right-arrow-alt"></i>Danh mục</a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="menu-title">Hóa đơn</div>
            </a>
            <ul>
                <li> <a href="{{route('admin_order_list')}}"><i class="bx bx-right-arrow-alt"></i>Mới nhất</a>
                </li>
                <li> <a href="{{route('admin_order_yes')}}"><i class="bx bx-right-arrow-alt"></i>Đã xử lý</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="menu-title">Sản phẩm</div>
            </a>
            <ul>
                <li> <a href="{{route('admin_prd_list')}}"><i class="bx bx-right-arrow-alt"></i>Danh sách sản phẩm</a>
                </li>
            </ul>
        </li>
    </ul>
</li>
