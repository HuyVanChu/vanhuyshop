@extends('backend.master.master')
@section('title')
    Bình luận bài viết đã xử lý
@endsection
@section('main')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            {!! show_errors_request($errors, 'comment') !!}
            {!! alert_success(session('thong-bao-thanh-cong')) !!}
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">Bình luận bài viết đã xử lý</h5>
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
                                    <th>Bài viết</th>
                                    <th>Ảnh bài viết</th>
                                    <th>Xem bình luận</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comment_blogs as $key => $comment_blog)
                                    @if ($comment_blog->user_id != null)
                                        <tr>
                                            <td>#{{ $comment_blogs->firstitem() + $key }}</td>
                                            <td>
                                                <h6 class="mb-1 font-14">{{ $comment_blog->User->name }}</h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-1 font-14">{{ substr($comment_blog->Blogs->title, 0, 150)  }}...</h6>
                                            </td>
                                            <td><img src="../blogs/{{ $comment_blog->Blogs->image }}"
                                                    alt="{{ $comment_blog->Blogs->title }}" width="50px"></td>

                                            <td><button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#showcmt{{ $comment_blog->id }}">Xem</button></td>
                                            {{-- showcomment --}}
                                            <div class="modal fade" id="showcmt{{ $comment_blog->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <form method="post">
                                                        @csrf
                                                        <div class="modal-content bg-dark">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title text-white">Bình luận bài viết
                                                                    {{ $comment_blog->Blogs->title }}</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-white">
                                                                <div class="mb-3">
                                                                    <p>Khách hàng: {{ $comment_blog->user->name }}</p>
                                                                    <textarea class="form-control"
                                                                        disabled>{{ $comment_blog->comnent }}</textarea>
                                                                </div>
                                                                @foreach ($comment_blogs_admin as $value)
                                                                    @if ($value->parent == $comment_blog->id)
                                                                    <form method="post">
                                                                        @csrf
                                                                        <div class="mb-3">
                                                                            <p>Admin: {{ $value->user_admin->name }}
                                                                            </p>
                                                                            <textarea class="form-control" name="comment">{{ $value->comnent }}</textarea>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <input type="hidden" name="comment_id"
                                                                                value="{{ $value->id }}">
                                                                            <button type="submit" class="btn btn-light" name="add_cmt_da_rep_2" value="1">
                                                                                Sửa bình luận của admin 1
                                                                            </button>
                                                                            <button type="button" class="btn btn-light"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#xoabl{{ $value->id }}">
                                                                                Xóa bình luận của admin 1
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
                                                                                                    disabled>{{ $value->comnent }}</textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <a href="{{ route('admin.removecmt', ['id' => $value->id, 'admin' => 'admin']) }}"
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
                                                    data-bs-target="#xoa{{ $comment_blog->id }}">Xóa</a>
                                                <a class="btn btn-warning" href="" data-bs-toggle="modal"
                                                    data-bs-target="#traloi{{ $comment_blog->id }}">Trả lời</a>
                                            </td>
                                            <!-- Tra loi thêm -->
                                            <div class="modal fade" id="traloi{{ $comment_blog->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content bg-dark">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-white">Trả lời bình luận của
                                                                {{ $comment_blog->User->name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form method="post">
                                                            @csrf
                                                            <div class="modal-body text-white">
                                                                <div class="mb-3">
                                                                    <p>Nội dung bình luận: </p>
                                                                    <textarea class="form-control"
                                                                        disabled>{{ $comment_blog->comnent }}</textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <p>Nội dung trả lời: </p>
                                                                    <textarea class="form-control" name="comment"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="id_cmt_con" value="{{$comment_blog->id}}">
                                                                <input type="hidden" name="blog_id" value="{{$comment_blog->Blogs->id}}">
                                                                <input type="hidden" name="name_user_comment" value="{{ $comment_blog->User->name }}">
                                                                <button type="submit" class="btn btn-success" name="add_cmt_da_rep_1" value="1">Thêm</button>
                                                            </div>
                                                        </form>

                                                    </div>

                                                </div>
                                            </div>
                                            <!-- end Tra loi thêm -->
                                            <div class="modal fade" id="xoa{{ $comment_blog->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content bg-dark">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-white">Xóa bình luận của
                                                                {{ $comment_blog->User->name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-white">
                                                            <div class="mb-3">
                                                                <p>Nội dung bình luận: </p>
                                                                <textarea class="form-control"
                                                                    disabled>{{ $comment_blog->comnent }}</textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <p>Lưu ý: </p>
                                                                <p>Khi xóa bình luận này, sẽ xóa tất cả bình luận theo nó. Bạn vẫn muốn xóa?</p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="{{ route('admin.removecmt', ['id' => $comment_blog->id, 'remove_clien' => '1']) }}"
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
                        {{ $comment_blogs->links() }}
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <!--end page wrapper -->
@endsection
