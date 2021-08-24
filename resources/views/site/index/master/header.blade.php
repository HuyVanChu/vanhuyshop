<header id="header" class="header style2 style19">
    <div class="main-header">
        <div class="container">
            <div class="main-menu-wapper">
                <div class="row">
                    <div class="col-sm-12 col-md-3 logo-wapper">
                        @if (isset($setting))
                        <div class="logo">
                            <a href="{{ route('index') }}"><img src="../slogan/{{ $setting->logo }}" alt=""
                                    width="200" height="70"></a>
                        </div>
                        @endif
                    </div>
                    <div class="col-sm-12 col-md-9 menu-wapper">
                        <div class="box-control">
                            <form class="box-search show-icon" action="{{ route('search') }}" method="get">
                                {{-- Đã ẩn csrf bằng phương pháp
                                    https://laravel.com/docs/7.x/csrf#csrf-excluding-uris
                                    Vào thành tìm kiếm bên trái visual code tìm từ khóa VerifyCsrfToken --}}
                                <span class="icon"><span class="pe-7s-search"></span></span>
                                <div class="inner">
                                    <input type="text" class="search" placeholder="Tìm sản phẩm" name="q">
                                    <button class="button-search" type="submit"><span
                                            class="pe-7s-search"></span></button>
                                </div>
                            </form>
                            <div class="mini-cart">
                                <a class="cart-link"><span class="pe-7s-cart"></span> <span
                                        class="count">{{ Cart::Content()->count() }}</span></a>
                                {{-- <a class="cart-link" href=""><span class="pe-7s-cart"></span> <span
                                        class="count">{{ Cart::Content()->count() }}</span></a> --}}
                                <div class="show-shopping-cart">
                                    <h3 class="title">BẠN CÓ <span
                                            class="text-primary">({{ Cart::Content()->count() }} SẢN PHẨM)</span>
                                        TRONG GIỎ
                                        HÀNG</h3>
                                    <ul class="list-product">
                                        @foreach (Cart::Content() as $item)
                                            <li>
                                                <div class="thumb">
                                                    <img src="../product/{{ $item->options->img }}"
                                                        alt="{{ $item->name }}">
                                                </div>
                                                <div class="info">
                                                    <h4 class="product-name">{{ $item->name }}</h4>
                                                    <span>
                                                        @if ($item->options->attr != null)
                                                            @foreach ($item->options->attr as $key => $value)
                                                                | {{ $key }} : {{ $value }}
                                                            @endforeach
                                                        @endif
                                                    </span>
                                                    <br>
                                                    <span class="price">{{ number_format($item->price, 0, '', ',') }}
                                                        VNĐ</span>
                                                    <a class="remove-item"
                                                        onclick="return del_cart('{{ $item->name }}')"
                                                        href="{{ route('removecart', ['id' => $item->rowId]) }}"><i
                                                            class="fa fa-close"></i></a>
                                                </div>
                                            </li>
                                        @endforeach

                                    </ul>

                                    @if (Cart::Content()->count() > 0)
                                        <div class="sub-total">
                                            Tổng tiền:
                                            {{ number_format(str_replace(',', '', Cart::subtotal()), 0, '', ',') }}
                                            VNĐ
                                        </div>
                                        <div class="group-button">
                                            <a href="{{ route('cart.add') }}" class="button">Giỏ hàng</a>
                                            <a href="{{ route('checkOut') }}" class="check-out button">Thanh toán</a>
                                        </div>
                                    @endif

                                </div>
                            </div>
                            <div class="box-settings">
                                <span class="icon bar">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </span>
                                <div class="settings-wrapper ">
                                    <div class="setting-content">
                                        <div class="setting-option">
                                            <ul>
                                                @if (Auth::guard('guest')->check())
                                                    <li><a href="{{ route('logoutsite') }}"><i
                                                                class="icon-user icons"></i><span>Đăng xuất</span></a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="{{ route('sigin_site') }}">
                                                            <i class="icon-lock-open icons"></i>
                                                            <span>Đăng nhập /</span>
                                                        </a>
                                                        <a href="{{ route('site_signup') }}">
                                                            <i class="icon-lock-open icons"></i>
                                                            <span>Đăng ký</span>
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <ul class="boutique-nav main-menu clone-main-menu">
                            <li @yield('active')>
                                <a href="{{ route('index') }}" style="font-family: sans-serif">Trang chủ</a>
                            </li>
                            <li @yield('active_product')>
                                <a href="{{ route('shop') }}" style="font-family: sans-serif">Cửa hàng</a>
                            </li>
                            <li @yield('active_blog')>
                                <a href="{{ route('blogList') }}" style="font-family: sans-serif">Bài viết</a>
                            </li>
                        </ul>
                        <span class="mobile-navigation"><i class="fa fa-bars"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
