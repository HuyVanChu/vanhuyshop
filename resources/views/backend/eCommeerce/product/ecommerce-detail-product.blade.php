@extends('backend.master.master')
@section('title')
    Chi tiết sản phẩm {{ $product->name }}
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
                            <li class="breadcrumb-item active" aria-current="page">Chi tiết sản phẩm {{ $product->name }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-4 border-end">
                        <img src="../product/{{ $product->image }}" class="img-fluid" alt="{{ $product->name }}">
                        <div class="row mb-3 row-cols-auto g-2 justify-content-center mt-3">
                            <div class="col"><img src="../product/{{ $product->image }}"
                                width="70" class="border rounded cursor-pointer"
                                alt="{{ $product->image }}"></div>
                        <div class="col"><img src="../product/{{ $product->image2 }}"
                                width="70" class="border rounded cursor-pointer" alt="{{ $product->image2 }}">
                        </div>
                            @foreach ($product->productdetail as $prd_detail_item)
                                <div class="col"><img src="../product/product_detail/{{ $prd_detail_item->image }}"
                                        width="70" class="border rounded cursor-pointer"
                                        alt="{{ $prd_detail_item->image }}"></div>

                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-title">{{ $product->name }}</h4>
                            <div class="d-flex gap-3 py-3">
                                <div>{{$product->comment->count()}} bình luận</div>

                            </div>
                            <div class="mb-3">
                                <span class="price h4">{{ number_format($product->price, 0, '', ',') }} VND</span>
                            </div>
                            <div class="mb-3">
                                <p>Giới thiệu:</p>
                                <p class="card-text fs-6">{!! $product->info !!}</p>
                            </div>
                            <dl class="row">
                                <p>Thuộc tính riêng:</p>
                                @foreach ($category->Properties as $propertie_Item)
                                    <span class="col-sm-3">{{ $propertie_Item->column }}: </span>
                                    @foreach ($propertie_Item->values as $value_column_item)
                                        <span class="col-sm-9">{{ $value_column_item->value }}</span>
                                @endforeach
                                @endforeach
                            </dl>
                            <hr>
                            <div class="row row-cols-auto row-cols-1 row-cols-md-3 align-items-center">
                                {{-- <div class="col">
                                    <label class="form-label">Số lượng</label>
                                    <div class="input-group input-spinner">
                                        <input disabled type="text" class="form-control" value="{{ $product->amount }}">
                                    </div>
                                </div> --}}
                                <div class="col">
                                    @foreach (attr_values($product->values) as $attibute => $values)
                                        <p>{{ $attibute }}:
                                            @foreach ($values as $value_item)
                                                {{ $value_item }},
                                            @endforeach
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="card-body">
                    <ul class="nav nav-tabs mb-0" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab"
                                aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-comment-detail font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">Mô tả</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#primarycontact" role="tab"
                                aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-star font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">Bình luận</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content pt-3">
                        <div class="tab-pane fade show active" id="primaryhome" role="tabpanel">
                            {!!$product->describer!!}
                        </div>
                        <div class="tab-pane fade" id="primarycontact" role="tabpanel">
                            @if ($product->comment->count()==0)
                            <p>Chưa có đánh giá sản phẩm</p>
                            @else
                            @foreach ($product->comment as $item)
                            <div class="mb-3">
                                <label for="inputProductTitle" class="form-label">{{ $item->users->name }}</label>
                                <input type="text" name="" class="form-control" value="{{ $item->comment }}" disabled>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
