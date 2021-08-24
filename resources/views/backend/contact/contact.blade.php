@extends('backend.master.master')
@section('title')
    Cấu hình trang liên hệ Website
@endsection
@section('main')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Cấu hình</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <h6 class="mb-0 text-uppercase">Cấu hình trang liên hệ cho Website của bạn</h6>
            <hr>
            <div class="card">
                <div class="card-body">
                    <div class="row row-cols-auto g-3">
                        <div class="col">
                            <button type="button" class="btn btn-dark px-5" data-bs-toggle="modal"
                                data-bs-target="#title1">Title 1</button>
                                <div class="modal fade" id="title1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                {!!$contact->title1!!}
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{route('editcontact',['id'=>$contact->id,'subtitle1'=>'1'])}}" class="btn btn-warning">Sửa</a>
                                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Hủy</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <button type="button" class="btn btn-dark px-5" data-bs-toggle="modal"
                                data-bs-target="#title2">Title 2</button>
                                <div class="modal fade" id="title2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header" style="overflow: auto;">
                                                {!!$contact->title2!!}
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{route('editcontact',['id'=>$contact->id,'subtitle2'=>'2'])}}" class="btn btn-warning">Sửa</a>
                                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Hủy</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <button type="button" class="btn btn-dark px-5" data-bs-toggle="modal"
                                data-bs-target="#title3">Title 3</button>
                                <div class="modal fade" id="title3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header" style="overflow: auto;">
                                                {!!$contact->title3!!}
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{route('editcontact',['id'=>$contact->id,'subtitle3'=>'3'])}}" class="btn btn-warning">Sửa</a>
                                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Hủy</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
        </div>
    </div>

@endsection
