@extends('backend.master.master')
@section('title')
    Sửa thuộc tính {{ $propertie->column }}
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
                            <li class="breadcrumb-item active" aria-current="page">Admin <i class="lni lni-chevron-right"></i> Sửa thuộc tính <i class="lni lni-chevron-right"></i> {{ $propertie->column }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card">
                <div class="card-body p-4">
                    <div class="form-body mt-4">
                        <form action="{{ route('admin_attr_editattrpost', ['name' => $propertie->column,'id'=>$propertie->id]) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="mb-3">
                                            <label for="inputProductTitle" class="form-label">Tên thuộc tính</label>
                                            <input type="text" name="name" class="form-control" id="inputProductTitle"
                                                placeholder="Bắt buộc" @if (old('name')) value="{{old('name')}}" @else value="{{$propertie->column}}" @endif>
                                            <input type="hidden" name="slug_cat" value="{{$slug_cat}}">
                                        </div>
                                        {!! show_errors_request($errors, 'name') !!}
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-light">Lưu thương hiệu</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop
@endsection
