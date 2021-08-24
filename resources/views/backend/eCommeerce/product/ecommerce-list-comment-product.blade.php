@extends('backend.master.master')
@section('title')
    Bình luận sản phẩm chưa xử lý
@endsection
@section('main')
    <div class="page-wrapper">
        <div class="page-content">
            {!! show_errors_request($errors, 'comment') !!}
            {!! alert_success(session('thong-bao-thanh-cong')) !!}
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">Bình luận sản phẩm chưa xử lý</h5>
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
                                    <th>Tên Khách hàng</th>
                                    <th>Sản phẩm</th>
                                    <th>Ảnh sản phẩm</th>
                                    <th>Xem bình luận</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comment_products as $key => $comment_product)
                                    <tr>
                                        <td>#{{ $comment_products->firstitem() + $key }}</td>
                                        <td>
                                            <h6 class="mb-1 font-14">{{ $comment_product->user->name }}</h6>
                                        </td>
                                        <td>
                                            <h6 class="mb-1 font-14">{{ $comment_product->product->name }}</h6>
                                        </td>
                                        <td><img src="../product/{{ $comment_product->product->image }}"
                                                alt="{{ $comment_product->product->name }}" width="50px"></td>

                                        <td><button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#showcmt{{ $comment_product->id }}">Xem</button></td>
                                        {{-- showcomment --}}
                                        <div class="modal fade" id="showcmt{{ $comment_product->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content bg-dark">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-white">Bình luận sản phẩm
                                                            {{ $comment_product->product->name }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-white">
                                                        <div class="mb-3">
                                                            <p>Khách hàng: {{ $comment_product->user->name }}</p>
                                                            <textarea class="form-control" disabled>{{$comment_product->comment}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                                            data-bs-target="#repcmt{{ $comment_product->id }}">Trả
                                                            lời</button>
                                                        <button type="button" class="btn btn-light"
                                                            data-bs-dismiss="modal">Trở
                                                            lại</button>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        {{-- end show comment --}}
                                        {{-- rep --}}
                                        <div class="modal fade" id="repcmt{{ $comment_product->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <form method="post">
                                                    @csrf
                                                    <div class="modal-content bg-dark">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-white">Trả lời bình luận
                                                                của {{ $comment_product->user->name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-white">
                                                            <div class="mb-3">
                                                                <p>Nội dung: </p>
                                                                <textarea class="form-control" name="comment"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="id" value="{{$comment_product->id}}">
                                                            <input type="hidden" name="name_user" value="{{$comment_product->user->name}}">
                                                            <input type="hidden" name="commen_id" value="{{$comment_product->id}}">
                                                            <input type="hidden" name="commen_prd_id" value="{{$comment_product->product->id}}">
                                                            <input type="hidden" name="product_id" value="{{$comment_product->product->id}}">
                                                            <button type="submit" class="btn btn-light">Trả lời bình luận</button>
                                                            <button type="button" class="btn btn-light"
                                                                data-bs-dismiss="modal">Trở
                                                                lại</button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                        {{-- end rep --}}
                                        <td>
                                            <a class="btn btn-warning" href="" data-bs-toggle="modal"
                                            data-bs-target="#xoa{{ $comment_product->id }}" >Xóa</a>
                                        </td>
                                        <!-- Modal -->
                                        <div class="modal fade" id="xoa{{ $comment_product->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content bg-dark">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-white">Xóa bình luận của {{ $comment_product->user->name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-white">
                                                            <div class="mb-3">
                                                                <p>Nội dung bình luận: </p>
                                                                <textarea class="form-control" disabled>{{$comment_product->comment}}</textarea>                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="{{route('admin_cmt_remove',['id'=>$comment_product->id])}}" class="btn btn-light">Xóa</a>
                                                        </div>
                                                    </div>

                                            </div>
                                        </div>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{ $comment_products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
