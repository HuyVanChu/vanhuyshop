@extends('backend.master.master')
@section('title')
    Danh sách tìm kiếm sản phẩm theo {{$name}}
@endsection
@section('main')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-lg-3 col-xl-2">
                                    <a href="{{route('admin_prd_choose')}}"
                                        class="btn btn-light mb-3 mb-lg-0"><i class='bx bxs-plus-square'></i>Thêm</a>
                                </div>
                                <div class="col-lg-9 col-xl-10">
                                    <form class="float-lg-end" action="{{ route('admin_prd_se') }}" method="get">
                                        @csrf
                                        <div class="row row-cols-lg-auto g-2">
                                            <div class="col-12">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control ps-5"
                                                        placeholder="Tìm sản phẩm..." name="name"> <span
                                                        class="position-absolute top-50 product-show translate-middle-y"><i
                                                            class="bx bx-search"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! show_errors_request($errors, 'name') !!}
            {!! alert_success(session('thong-bao-thanh-cong')) !!}
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">Tìm thấy {{$count}} sản phẩm theo tên "{{$name}}"</h5>
                        </div>
                        <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Giá</th>
                                    <th>Giá</th>
                                    <th>Danh mục</th>
                                    <th>Thương hiệu</th>
                                    <th>Số lượng</th>
                                    <th>Xem chi tiết</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key =>  $product)
                                <tr>
                                    <td>#{{$products->firstitem() + $key}}</td>
                                    <td><h6 class="mb-1 font-14">{{$product->name}}</h6></td>
                                    <td><img src="../product/{{$product->image}}" alt="{{$product->name}}" width="50px"></td>
                                    <td>{{number_format($product->price, 2, ',', '')}}</td>
                                    <td>{{$product->categories->name}}</td>
                                    <td>{{$product->Trademaks->name}}</td>
                                    <td>{{$product->amount}}</td>
                                    <td>
                                        <a class="btn btn-warning" href="{{route('admin_prd_detail',['slug'=>$product->slug])}}" >Chi tiết</a>
                                    </td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a href="{{route('admin_prd_edit',['slug'=>$product->slug])}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit text-white"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                            </a>
                                            <a href="" onclick="$('#dialog-example_{{$product->id}}').modal('show');" data-toggle="modal" data-target="#exampleModal"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-white"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>                                        </div>
                                            </a>
                                        </div>
                                    </td>
                                    <div id="dialog-example_{{$product->id}}" class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div id="dialog-example_{{$product->id}}" class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Bạn muốn xóa sản phẩm {{ $product->name }} ?</h5>
                                                    <i class="lni lni-close" data-dismiss="modal"
                                                    aria-label="Close" onclick="$('#dialog-example_{{$product->id}}').modal('hide');"></i>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success"
                                                        data-dismiss="modal" onclick="$('#dialog-example_{{$product->id}}').modal('hide');">Hủy</button>
                                                    <a href="{{route('admin_prd_delete',['id'=>$product->id,'name'=>$product->name])}}"><button type="button" class="btn btn-danger">Xóa</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{$products->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
