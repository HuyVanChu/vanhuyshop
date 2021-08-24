@extends('backend.master.master')
@section('title')
    Không tìm thấy trang
@endsection
@section('main')
<div class="page-wrapper">
    <div class="page-content">
        <div class="wrapper">
            <div class="wrapper">
                <div class="error-404 d-flex align-items-center justify-content-center">
                    <div class="container">
                        <div class="card">
                            <div class="row g-0">
                                <div class="col-xl-5">
                                    <div class="card-body p-4">
                                        <h1 class="display-1"><span class="text-white">5</span><span class="text-white">0</span><span class="text-white">0</span></h1>
                                        <h2 class="font-weight-bold display-4">Sorry, unexpected error</h2>
                                        <p>Looks like you are lost!
                                            <br>May be you are not connected to the internet!</p>
                                    </div>
                                </div>
                                <div class="col-xl-7">
                                    <img src="../505-error.png" class="img-fluid" alt="">
                                </div>
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
