@extends('backend.master.master')
@section('title')
    Chọn danh mục
@endsection
@section('main')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card">
                <div class="card-body p-4">
                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-12">
                                {!!alert_warning(session('thong-bao-loi'))!!}
                                @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                                <div class="border border-3 p-4 rounded">
                                    <form action="{{route('admin_prd_choosepost')}}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="">Chọn danh mục:</label>
                                            <select class="form-control" name="choose" id="">
                                                {!!list_category($categories, 0, '');!!}
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-success">Chọn</button>
                                            <a href="{{route('admin_prd_list')}}"><button type="button" class="btn btn-danger">Hủy</button></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
