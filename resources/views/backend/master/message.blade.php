<div class="user-box dropdown">
    <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="../users/{{Auth::user()->image}}" class="user-img user-online" alt="user avatar">
        <div class="user-info ps-3">
            <p class="user-name mb-0">{{Auth::user()->name}}</p>
            <p class="designattion mb-0">Admin</p>
        </div>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        <li><a class="dropdown-item" href="{{route('admin_user_detail',['slug'=>Auth::user()->slug])}}"><i class="bx bx-user"></i><span>Trang cá nhân</span></a>
        </li>
        <li>
            <div class="dropdown-divider mb-0"></div>
        </li>
        <li><a class="dropdown-item" href="{{route('logout')}}"><i class='bx bx-log-out-circle'></i><span>Đăng xuất</span></a>
        </li>
    </ul>
</div>
