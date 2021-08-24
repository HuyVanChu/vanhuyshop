@extends('backend.master.master')
@section('title')
    Cấu trúc danh mục
@endsection
@section('main')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card">
                <div class="card-body p-4">
                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="border border-3 p-4 rounded">
                                        <div class="mb-3">
                                            <label for="">Cấu trúc danh mục:</label>
                                            <select class="form-control" name="choose" id="">
                                                {!! list_category($categories, 0, '') !!}
                                            </select>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
