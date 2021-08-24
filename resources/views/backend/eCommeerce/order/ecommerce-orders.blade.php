@extends('backend.master.master')
@section('title')
    Danh sách hóa đơn mới nhất
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
                        <li class="breadcrumb-item active" aria-current="page">Hóa đơn mới nhất</li>
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
                        <input name="q" type="text" class="form-control ps-5 radius-30" placeholder="Nhập tên hoặc ID"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
                    </div>
                    </form>
                  <div class="ms-auto"><a href="javascript:;" class="btn btn-light radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>Thêm mới đơn hàng</a></div>
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
                                <th>Actions</th>
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
                                    <div class="d-flex order-actions">
                                        <a href="{{route('admin_order_detail',['id'=>$customer->id,'name'=>$customer->slug])}}" class=""><i class='bx bxs-edit'></i></a>
                                        <a href="" class="ms-3" onclick="$('#dialog-example_{{$customer->id}}').modal('show');" data-toggle="modal" data-target="#exampleModal"><i class='bx bxs-trash'></i></a>
                                    </div>
                                    <div id="dialog-example_{{$customer->id}}" class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div id="dialog-example_{{$customer->id}}" class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Bạn muốn hủy đơn hàng {{ $customer->name }} ?</h5>
                                                    <i class="lni lni-close" data-dismiss="modal"
                                                    aria-label="Close" onclick="$('#dialog-example_{{$customer->id}}').modal('hide');"></i>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success"
                                                        data-dismiss="modal" onclick="$('#dialog-example_{{$customer->id}}').modal('hide');">Hủy</button>
                                                    <a href="{{route('admin_order_delete',['id'=>$customer->id,'name'=>$customer->name])}}"><button type="button" class="btn btn-danger">Xóa</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

