@extends('backend.master.master')
@section('title')
    Danh sách Danh mục
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
                                    <a href="{{ route('admin_cat_chose') }}" class="btn btn-light mb-3 mb-lg-0"><i
                                            class='bx bxs-plus-square'></i>Thêm</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                           <a href="{{route('admin_cat_structure')}}"><h5 class="mb-0">Xem cấu trúc danh mục</h5></a>
                        </div>
                        <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                        </div>
                    </div>
                    {!! alert_success(session('thong-bao-thanh-cong')) !!}
                    {!!alert_warning(session('thong-bao-loi'))!!}
                    <hr>
                    <div class="table-responsive">

                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Ảnh</th>
                                    <th>Cấp</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Categories as $key => $category)
                                    <tr>
                                        <td>{{ $Categories->firstitem() + $key }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">

                                                <div class="ms-2">
                                                    <h6 class="mb-1 font-14">{{ $category->name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="">
                                                    <img src="../category/{{ $category->image }}"
                                                        alt="{{ $category->name }}" width="100px">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($category->cate_smail==0)
                                            <span class="badge badge-success"
                                                style="background: rgb(245, 4, 4)">Cha</span>
                                            @else
                                            <span class="badge badge-success"
                                            style="background: rgb(5, 201, 31)">Con</span>
                                            @endif

                                        </td>
                                        <td>
                                            <div class="d-flex order-actions">
                                                <a
                                                    href="{{ route('admin_cat_edit', ['slug' => $category->slug ,'parent' => $category->parent ,'cat_name' => $category->name,'cat_id' => $category->id]) }}"><svg
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
                                                <a onclick="$('#dialog-example_{{$category->id}}').modal('show');" data-toggle="modal" data-target="#exampleModal"><svg
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
                                            <div id="dialog-example_{{$category->id}}" class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div id="dialog-example_{{$category->id}}" class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Bạn muốn xóa
                                                                thương hiệu {{ $category->name }}</h5>
                                                            <i class="lni lni-close" data-dismiss="modal"
                                                            aria-label="Close" onclick="$('#dialog-example_{{$category->id}}').modal('hide');"></i>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-success"
                                                                data-dismiss="modal" onclick="$('#dialog-example_{{$category->id}}').modal('hide');">Hủy</button>
                                                            <a href="{{route('admin_cat_delete',['slug'=>$category->slug,'id'=>$category->id,'name'=>$category->name])}}"><button type="button" class="btn btn-danger">Xóa</button></a>
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
            {{ $Categories->links() }}
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
