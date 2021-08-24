@extends('backend.master.master')
@section('title')
    Thêm giá trị cho biến thể sản phẩm {{ $product->name }}
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
                            <li class="breadcrumb-item active" aria-current="page">Thêm giá trị cho biến thể sản phẩm
                                {{ $product->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
            {!! alert_success(session('thong-bao-thanh-cong')) !!}
            {!! alert_warning(session('thong-bao-loi')) !!}
            @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="card">
                <div class="card-body">
                    <form method="post">
                        @csrf
                        <div class="panel-heading" align='center'>
                            <h6>Giá cho từng biến thể sản phẩm : {{ $product->name }} ({{ $product->product_code }})</h6>
                        </div>
                        <div class="panel-body" align='center'>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Biến thể</th>
                                        <th>Giá (có thể trống)</th>
                                        <th>Tuỳ chọn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product->variant as $variant)
                                        <tr>
                                            <td scope="row">
                                                @foreach ($variant->values as $value)
                                                    {{ $value->attribute->name }} : {{ $value->value }},
                                                @endforeach

                                            </td>
                                            <td>
                                                <input name="variant[{{ $variant->id }}]" class="form-control"
                                                    placeholder="Giá cho biến thể" value="{{ $variant->price }}">
                                            </td>
                                            <td>
                                                <a href="" onclick="$('#dialog-example_{{ $variant->id }}').modal('show');"
                                                    data-toggle="modal" data-target="#exampleModal" class="btn btn-danger"
                                                    role="button">Xoá</a>
                                            </td>
                                            <div id="dialog-example_{{ $variant->id }}" class="modal fade"
                                                id="exampleModal" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div id="dialog-example_{{ $variant->id }}" class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Bạn muốn xóa biến
                                                                thể {{$variant->id}}</h5>
                                                            <i class="lni lni-close" data-dismiss="modal" aria-label="Close"
                                                                onclick="$('#dialog-example_{{ $variant->id }}').modal('hide');"></i>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-success"
                                                                data-dismiss="modal"
                                                                onclick="$('#dialog-example_{{ $variant->id }}').modal('hide');">Hủy</button>
                                                            <a href="{{route('admin_prd_deleteattr',['id'=>$variant->id])}}"><button type="button"
                                                                    class="btn btn-danger">Xóa</button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div align='right'>
                            @if ($count>0)
                            <button class="btn btn-success" type="submit"> Cập nhật </button>
                            <a class="btn btn-danger" href="{{route('admin_prd_list')}}" role="button">Bỏ qua</a>
                            @else
                            <button type="button" class="btn btn-danger">Sản phẩm chưa có biến thể</button>
                            @endif
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
