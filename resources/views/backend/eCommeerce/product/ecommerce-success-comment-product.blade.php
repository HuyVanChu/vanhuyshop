@extends('backend.master.master')
@section('title')
    Bình luận sản phẩm đã xử lý
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
                            <h5 class="mb-0">Bình luận sản phẩm đã xử lý</h5>
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
                                    @if ($comment_product->use_id != null)
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
                                                    <form method="post">
                                                        @csrf
                                                        <div class="modal-content bg-dark">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title text-white">Bình luận sản phẩm
                                                                    {{ $comment_product->product->name }}</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-white">
                                                                <div class="mb-3">
                                                                    <p>Khách hàng: {{ $comment_product->user->name }}</p>
                                                                    <textarea class="form-control"
                                                                        disabled>{{ $comment_product->comment }}</textarea>
                                                                </div>
                                                                @foreach ($comment_products_admin as $value)
                                                                    @if ($value->parent == $comment_product->id)
                                                                    <form method="post">
                                                                        @csrf
                                                                        <div class="mb-3">
                                                                            <p>Admin: {{ $value->user_admin->name }}
                                                                            </p>
                                                                            <textarea class="form-control" name="comment">{{ $value->comment }}</textarea>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <input type="hidden" name="comment_id"
                                                                                value="{{ $value->id }}">
                                                                            <button type="submit" class="btn btn-light" name="add_cmt_da_rep" value="1">
                                                                                Sửa bình luận của admin 1
                                                                            </button>
                                                                            <button type="button" class="btn btn-light"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#xoabl{{ $value->id }}">
                                                                                Xóa bình luận của admin
                                                                            </button>
                                                                            {{-- remove comment admin --}}
                                                                            <div class="modal fade"
                                                                                id="xoabl{{ $value->id }}" tabindex="-1"
                                                                                aria-hidden="true">
                                                                                <div
                                                                                    class="modal-dialog modal-lg modal-dialog-centered">
                                                                                    <div class="modal-content bg-dark">
                                                                                        <div class="modal-header">
                                                                                            <h5
                                                                                                class="modal-title text-white">
                                                                                                Xóa bình luận của
                                                                                                {{ $value->user_admin->name }}
                                                                                            </h5>
                                                                                            <button type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body text-white">
                                                                                            <div class="mb-3">
                                                                                                <p>Nội dung bình luận: </p>
                                                                                                <textarea
                                                                                                    class="form-control"
                                                                                                    disabled>{{ $value->comment }}</textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <a href="{{ route('admin_cmt_remove', ['id' => $value->id, 'admin' => 'admin']) }}"
                                                                                                class="btn btn-light">Xóa</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            {{-- end remove comment admin --}}
                                                                        </div>
                                                                    </form>

                                                                    @endif
                                                                @endforeach

                                                            </div>

                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                            {{-- end show comment --}}

                                            <td>
                                                <a class="btn btn-warning" href="" data-bs-toggle="modal"
                                                    data-bs-target="#xoa{{ $comment_product->id }}">Xóa</a>
                                                <a class="btn btn-warning" href="" data-bs-toggle="modal"
                                                    data-bs-target="#traloi{{ $comment_product->id }}">Trả lời</a>
                                            </td>
                                            <!-- Tra loi thêm -->
                                            <div class="modal fade" id="traloi{{ $comment_product->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content bg-dark">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-white">Trả lời bình luận của
                                                                {{ $comment_product->user->name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{route('admin_cmt_productpost')}}" method="post">
                                                            @csrf
                                                            <div class="modal-body text-white">
                                                                <div class="mb-3">
                                                                    <p>Nội dung bình luận: </p>
                                                                    <textarea class="form-control"
                                                                        disabled>{{ $comment_product->comment }}</textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <p>Nội dung trả lời: </p>
                                                                    <textarea class="form-control" name="comment"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="id_cmt_con" value="{{$comment_product->id}}">
                                                                <input type="hidden" name="prd_id" value="{{$comment_product->product->id}}">
                                                                <input type="hidden" name="name_user_comment" value="{{ $comment_product->user->name }}">
                                                                <button type="submit" class="btn btn-success" name="add_cmt_da_rep" value="1">Thêm</button>
                                                            </div>
                                                        </form>

                                                    </div>

                                                </div>
                                            </div>
                                            <!-- end Tra loi thêm -->
                                            <div class="modal fade" id="xoa{{ $comment_product->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content bg-dark">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-white">Xóa bình luận của
                                                                {{ $comment_product->user->name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-white">
                                                            <div class="mb-3">
                                                                <p>Nội dung bình luận: </p>
                                                                <textarea class="form-control"
                                                                    disabled>{{ $comment_product->comment }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="{{ route('admin_cmt_remove', ['id' => $comment_product->id, 'admin' => 'admin']) }}"
                                                                class="btn btn-light">Xóa</a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </tr>
                                    @endif
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
