<!doctype html>
<html lang="vi">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{ asset('') }}backend/">
    <script src="assets/js/jquery-1.11.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
    <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <link href="assets/css/pace.min.css" rel="stylesheet" />
    <script src="assets/js/pace.min.js"></script>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link href="assets/css/app.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    <title>@yield('title')</title>
</head>
<body class="bg-theme bg-theme1">
    <div class="wrapper">
        <header>
            <div class="topbar d-flex align-items-center">
                <nav class="navbar navbar-expand">
                    <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                    </div>
                    <div class="search-bar flex-grow-1">
                        <form action="{{route('admin_order_search')}}" method="get">
                            @csrf
                            <div class="position-relative search-bar-box">
                                <input type="text" name="q" class="form-control search-control" placeholder="Tìm kiếm hóa đơn chưa xử lý">
                                <span class="position-absolute top-50 search-show translate-middle-y"><i
                                        class='bx bx-search'></i></span>
                                <span class="position-absolute top-50 search-close translate-middle-y"><i
                                        class='bx bx-x'></i></span>
                            </div>
                        </form>
                    </div>
                    <div class="top-menu ms-auto">
                        <ul class="navbar-nav align-items-center">
                            <li class="nav-item mobile-search-icon">
                                <a class="nav-link" href="#"> <i class='bx bx-search'></i>
                                </a>
                            </li>
                            @include('backend.master.notif')
                            <li class="nav-item mobile-search-icon">
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div class="header-message-list">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    @if (Auth::check())
                        <div class="user-box dropdown">
                            <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../users/{{ Auth::user()->image }}" class="user-img user-online"
                                    alt="user avatar">
                                <div class="user-info ps-3">
                                    <p class="user-name mb-0">{{ Auth::user()->name }}</p>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item"
                                        href="{{ route('admin_user_detail', ['slug' => Auth::user()->slug]) }}"><i
                                            class="bx bx-user"></i><span>Profile</span></a>
                                </li>
                                <li>
                                    <div class="dropdown-divider mb-0"></div>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}"><i
                                            class='bx bx-log-out-circle'></i><span>Đăng xuất</span></a>
                                </li>
                            </ul>
                        </div>
                    @endif
                </nav>
            </div>
        </header>
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                    <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
                </div>
                <div>
                    <a href="{{ route('admin.index') }}">
                        <h4 class="logo-text">Virgin7.vn</h4>
                    </a>
                </div>
                <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
                </div>
            </div>
            <ul class="metismenu" id="menu">
                <li class="menu-label">UI Elements</li>
                @include('backend.master.ecommerce')
                @role('super-admin')
                @include('backend.master.userprofile')
                @endrole
                @include('backend.blog.blog')
                @include('backend.master.content')
                @include('backend.master.notification')
                <li class="menu-label">Khác</li>
                <li>
                    <a target="_blank">
                        <div class="parent-icon"><i class="bx bx-support"></i>
                        </div>
                        <div class="menu-title">Hỗ trợ</div>
                    </a>
                </li>
            </ul>
        </div>
        @yield('main')
        <div class="overlay toggle-icon">
        </div>
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <footer class="page-footer">
            <p class="mb-0">Bản quyền 2021 © Virginf</p>
        </footer>
    </div>
    @section('script')
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
        <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
        <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
        <script src="assets/js/app.js"></script>
        <script src="assets/plugins/chartjs/js/Chart.min.js"></script>
        <script src="assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
        <script src="assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
        <script src="assets/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
        <script src="assets/plugins/jquery-knob/excanvas.js"></script>
        <script src="assets/plugins/jquery-knob/jquery.knob.js"></script>
        <script>
            $(function() {
                $(".knob").knob();
            });
        </script>
        <script src="assets/js/index.js"></script>
    @show
</body>

</html>
