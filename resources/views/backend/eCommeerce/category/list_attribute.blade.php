@extends('backend.master.master')
@section('title')
    Danh sách thuộc tính
@endsection
@section('main')
    <div class="page-wrapper">
        <div class="page-content">
             <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.index')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('admin.index')}}">Admin <i class="lni lni-chevron-right"></i></a> Danh sách thuộc tính {{$category->name}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">Danh sách thuộc tính</h5>
                        </div>
                        <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                        </div>
                    </div>
                    {!! alert_success(session('thong-bao-thanh-cong')) !!}
                    {!! alert_success_del(session('thong-bao-xoa-thanh-cong')) !!}
                    <hr>
                    <div class="table-responsive">

                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($properties as $key => $propertie)
                                    <tr>
                                        <td>{{ $properties->firstitem() + $key }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">

                                                <div class="ms-2">
                                                    <h6 class="mb-1 font-14">{{ $propertie->column }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex order-actions">
                                                <a
                                                    href="{{ route('admin_attr_editattr', ['slug_cat'=>$slug_cat,'name' => $propertie->column]) }}"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-edit text-white">
                                                        <path
                                                            d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                        </path>
                                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                <a onclick="$('#dialog-example_{{$propertie->id}}').modal('show');" data-toggle="modal" data-target="#exampleModal"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-trash-2 text-white">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                        </path>
                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                    </svg>
                                            </div>
                                            </a>
                                            <div id="dialog-example_{{$propertie->id}}" class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div id="dialog-example_{{$propertie->id}}" class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Bạn muốn xóa
                                                                thương hiệu {{ $propertie->column }}</h5>
                                                            <i class="lni lni-close" data-dismiss="modal"
                                                            aria-label="Close" onclick="$('#dialog-example_{{$propertie->id}}').modal('hide');"></i>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-success"
                                                                data-dismiss="modal" onclick="$('#dialog-example_{{$propertie->id}}').modal('hide');">Hủy</button>
                                                            <a href="{{route('admin_attr_delattr',['id'=>$propertie->id,'slug_cat'=>$slug_cat,'column'=>$propertie->column])}}"><button type="button" class="btn btn-danger">Xóa</button></a>
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
            {{ $properties->links() }}
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
