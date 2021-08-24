@extends('backend.master.master')
@section('title')
    Chi tiết hóa đơn {{$order->name}}
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
                        <li class="breadcrumb-item active" aria-current="page">Chi tiết hóa đơn: {{$order->name}}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h6 class="mb-0 text-uppercase">{{$order->name}}</h6>
                <hr/>
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item" aria-current="true">Tên khách: {{$order->name}}</li>
                            <li class="list-group-item">Số điện thoại: {{$order->phone}}</li>
                            <li class="list-group-item">Email: {{$order->email}}</li>
                            <li class="list-group-item">Địa chỉ: {{$order->address}}</li>
                            <li class="list-group-item">Yêu cầu khác:
                            </li>
                            <textarea disabled>{{$order->note}}</textarea>
                        </ul>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Ảnh</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Tổng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->OrderDetail as $key =>  $itemDetail)
                            <tr>
                                <td>
                                    <h6 class="mb-0 font-14">{{$key+1}}</h6>
                                </td>
                                <td>
                                    <p>{{$itemDetail->name}}</p>
                                    @foreach ($itemDetail->attr as $attr)
                                    <span>{{$attr->name}}: {{$attr->value}}<br></span>
                                    @endforeach
                                </td>
                                <td><img src="../product/{{$itemDetail->image}}" alt="" width="150px" height="150px"></td>
                                <td>{{$itemDetail->quantity}}</td>
                                <td>{{ number_format($itemDetail->price, 0, '', '.') }} VNĐ</td>
                                <td>{{ number_format($itemDetail->price*$itemDetail->quantity, 0, '', '.') }} VNĐ</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div align='right'>
                        <h5 style="margin-top: 10px">Tổng tiền: {{ number_format($order->total, 0, '', '.') }} VNĐ</h5>
                        @if (isset($tamp))
                        <a href="{{route('admin_order_list')}}" class="btn btn-success">Xem đơn hàng chưa xử lý</a>
                        @else
                        <a href="{{route('admin_order_success',['id'=>$order->id])}}" class="btn btn-success">Hoàn thành đơn hàng</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

