<!doctype html>
<html lang="vi">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{ asset('') }}backend/">
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
    <link href="assets/css/pace.min.css" rel="stylesheet" />
    <script src="assets/js/pace.min.js"></script>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link href="assets/css/app.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <title>Đăng kí tài khoản</title>
</head>

<body class="bg-theme bg-theme1">
    <div class="wrapper">
        <div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
                    <div class="col mx-auto">
                        <div class="my-4 text-center">
                            {{-- <img src="assets/images/logo-img.png" width="180" alt="" /> --}}
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="">Đăng ký</h3>
                                        <p>Bạn đã có tài khoản<a href="{{ route('sigin_site') }}">Đăng nhập tại đây</a>
                                        </p>
                                    </div>
                                    <div class="d-grid">
										<a class="btn my-4 shadow-sm btn-light" href="{{route('site.google')}}"> <span
												class="d-flex justify-content-center align-items-center">
												<img class="me-2" src="../login_site/search.svg" width="16"
													alt="Image Description">
												<span>Sign in with Google</span>
											</span>
										</a>
									</div>
                                    <hr />
                                    <div class="form-body">
                                        {!! show_errors_request_site($errors, 'name') !!}
                                        {!! show_errors_request_site($errors, 'phone') !!}
                                        {!! show_errors_request_site($errors, 'email') !!}
                                        {!! show_errors_request_site($errors, 'password') !!}
                                        {!! show_errors_request_site($errors, 'check') !!}
                                        {!! alert_warning(session('thong-bao-loi')) !!}
                                        {!! alert_successSite(session('thong-bao')) !!}

                                        <form class="row g-3" method="POST">
                                            @csrf
                                            <div class="col-sm-6">
                                                <label for="inputFirstName" class="form-label">Tên</label>
                                                <input type="text" class="form-control" id="inputFirstName"
                                                    placeholder="Nhập tên" name="name" value="{{ old('name') }}">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="inputLastName" class="form-label">Điện thoại</label>
                                                <input type="text" class="form-control" id="inputLastName"
                                                    placeholder="Nhập số điện thoại" name="phone"
                                                    value="{{ old('phone') }}">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Email</label>
                                                <input type="test" class="form-control" id="inputEmailAddress"
                                                    placeholder="Nhập email" name="email" value="{{ old('email') }}">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Mật khẩu</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control border-end-0"
                                                        placeholder="Mật khẩu"
                                                        name="password" value="{{ old('password') }}">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Nhập lại mật
                                                    khẩu</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control border-end-0"
                                                        placeholder="Mật khẩu"
                                                        name="password_check" value="{{ old('password') }}">

                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckChecked" name="check">
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">Tôi
                                                        đồng ý với Điều khoản & Điều kiện</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-light"><i
                                                            class='bx bx-user'></i>Đăng Kí</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>



