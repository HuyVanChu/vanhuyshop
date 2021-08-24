@extends('backend.master.master')
@section('title')
    Danh sách hóa đơn đã hoàn thành
@endsection
@section('main')
<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Danh sách hóa đơn đã hoàn thành</li>
                    </ol>
                </nav>
            </div>
        </div>
        {!!alert_success(session('thong-bao-thanh-cong'))!!}
        <div class="card">
            <div class="card-body">
                <div class="d-lg-flex align-items-center mb-4 gap-3">
                    <form action="{{route('admin_order_search')}}" method="get">
                        @csrf
                        <div class="position-relative">
                            <input type="text" name="search" class="form-control ps-5 radius-30" placeholder="Tìm hóa đơn đã xử lý"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Order#</th>
                                <th>Tên</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="ms-2">
                                            <h6 class="mb-0 font-14">#{{$customer->id}}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>{{$customer->name}}</td>
                                <td>{{$customer->phone}}</td>
                                <td>{{$customer->email}}</td>
                                <td>{{ number_format($customer->total, 0, '', '.') }} VNĐ</td>
                                <td>
                                    @if ($customer->state==0)
                                    <button type="button" class="btn btn-danger">Chưa Xử Lý</button>
                                    @else
                                    <button type="button" class="btn btn-success">Đã Xử Lý</button>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('admin_order_detail',['id'=>$customer->id,'tamp'=>'da-xa-ly'])}}" class="btn btn-danger">Xem chi tiết</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
