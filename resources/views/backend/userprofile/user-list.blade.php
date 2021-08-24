@extends('backend.master.master')
@section('title')
    Danh sách quản trị Website
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
                                    @can('add_user')
                                    <a href="{{ route('admin_user_add') }}" class="btn btn-light mb-3 mb-lg-0"><i
                                            class='bx bxs-plus-square'></i>Thêm</a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    {!!alert_success(session('thong-bao-thanh-cong'))!!}
                    {!!alert_warning(session('thong-bao-loi'))!!}
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Email</th>
                                <th scope="col">Quyền</th>
                                <th scope="col">Chi tiết</th>
                                @canany(['edit_user', 'delete_user'])
                                <th scope="col">Thao tác</th>
                                @endcanany
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key=> $user_item)
                            <tr>
                                <th scope="row">{{$users->firstitem() + $key}}</th>
                                <td>{{$user_item->name}}</td>
                                <td><img src="../users/{{$user_item->image}}" alt="{{$user_item->name}}" width="50px"></td>
                                <td>{{$user_item->phone}}</td>
                                <td>{{$user_item->email}}</td>
                                <td>
                                    @if ($user_item->level==0)
                                        <span style="background: rgb(9, 233, 9)" class="badge badge-success rounded">User</span>
                                    @elseif($user_item->level==1)
                                    <span style="background: rgb(8, 23, 235)" class="badge badge-primary rounded">Admin</span>
                                    @else
                                        <span style="background: rgb(235, 8, 19)" class="badge badge-danger rounded">Super Admin</span>
                                    @endif

                                </td>

                                <td><a href="{{route('admin_user_detail',['slug'=>$user_item->slug])}}"><button type="button" class="btn btn-light btn-sm radius-30 px-4">Xem chi tiết</button></a>
                                </td>
                                @canany(['edit_user', 'delete_user'])
                                <td>
                                    <a href="{{route('admin_user_edit',['slug'=>$user_item->slug])}}"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-edit text-white">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                            </path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                            </path>
                                        </svg>
                                    </a>
                                    <a onclick="$('#dialog-example_{{$user_item->id}}').modal('show');"
                                        data-toggle="modal" data-target="#exampleModal"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-trash-2 text-white">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path
                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                            </path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                    </a>
                                    <!-- Modal -->
                                    <div id="dialog-example_{{$user_item->id}}" class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div id="dialog-example_{{$user_item->id}}" class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Bạn muốn xóa quản trị {{ $user_item->name }} ?</h5>
                                                    <i class="lni lni-close" data-dismiss="modal"
                                                    aria-label="Close" onclick="$('#dialog-example_{{$user_item->id}}').modal('hide');"></i>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success"
                                                        data-dismiss="modal" onclick="$('#dialog-example_{{$user_item->id}}').modal('hide');">Hủy</button>
                                                    <a href="{{route('admin_user_delete',['id'=>$user_item->id,'name'=>$user_item->name])}}"><button type="button" class="btn btn-danger">Xóa</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                @endcanany
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
