@extends('backend.master.master')
@section('title')
    Cấu hình slide Website
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
                            <li class="breadcrumb-item active" aria-current="page">Cấu hình slide website</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <hr>
            <div class="card">
                <div class="card-body">
                    <div class="row row-cols-auto g-3">
                        <div class="col">

                            <div class="col">
                                <h6 class="mb-0 text-uppercase">Slide Demo</h6>
                                <hr />
                                <div class="card">
                                    <div class="card-body">
                                        <div id="carouselExampleFade" class="carousel slide carousel-fade"
                                            data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                <?php $i = 1; ?>
                                                @foreach ($slides as $key => $slide)
                                                    <div class="carousel-item <?php if ($i == 1) {
                                                            echo 'active';
                                                        } ?>">
                                                        <img src="../slides/{{ $slide->image }}" alt="..."
                                                            width="960" height="350">
                                                    </div>
                                                    <?php $i = 0; ?>
                                                @endforeach

                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleFade" role="button"
                                                data-bs-slide="prev"> <span class="carousel-control-prev-icon"
                                                    aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleFade" role="button"
                                                data-bs-slide="next"> <span class="carousel-control-next-icon"
                                                    aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </a>
                                        </div>
                                    </div>
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
                            <h5 class="mb-0">Danh sách slide</h5>
                        </div>

                        <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                        </div>
                    </div>
                    {!! show_errors_request($errors, 'image') !!}
                    {!! show_errors_request($errors, 'name') !!}
                    {!! alert_success(session('thong-bao')) !!}
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addnew">Thêm
                            mới</button>
                        <div class="modal fade" id="addnew" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content bg-dark">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-white">Thêm mới slide Website</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.addslide') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body text-white">
                                            <div class="mb-3">
                                                <label for="inputProductTitle" class="form-label">Title</label>
                                                <input type="text" name="name" class="form-control" id="inputProductTitle"
                                                    placeholder="Bắt buộc" value="{{ old('name') }}">

                                            </div>
                                            <div class="mb-3">
                                                <input id="img" type="file" name="image" class="form-control hidden"
                                                    onchange="changeImg(this)">
                                                <img id="avatar" name="image" class="thumbnail" width="100%" height="350px"
                                                    src="../slides/import-img.png">

                                            </div>
                                            <p>Lưu ý: khi thêm mới, Website của bạn sẽ thay đổi</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
                                            <button type="submit" class="btn btn-light">Thêm mới</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Hình ảnh</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($slides as $key => $slide)
                                    <tr>
                                        <td>#{{ $slides->firstitem() + $key }}</td>
                                        <td><img src="../slides/{{ $slide->image }}" height="250" width="500"></td>
                                        <td>
                                            <div class="d-flex order-actions">
                                                <a href="" data-bs-toggle="modal"
                                                    data-bs-target="#edit{{ $slide->id }}"><svg
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
                                                <div class="modal fade" id="edit{{ $slide->id }}" tabindex="-1"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                                        <div class="modal-content bg-dark">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title text-white">Sửa Slide Website</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form
                                                                action="{{ route('admin.editslide', ['id' => $slide->id]) }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="modal-body text-white">
                                                                    <div class="mb-3">
                                                                        <label for="inputProductTitle"
                                                                            class="form-label">Title</label>
                                                                        <input type="text" name="name" class="form-control"
                                                                            id="inputProductTitle" placeholder="Bắt buộc"
                                                                            value="{{ $slide->name }}">

                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <img id="avatar" name="image" class="thumbnail"
                                                                            width="100%" height="350px"
                                                                            src="../slides/{{ $slide->image }}">

                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="inputProductTitle"
                                                                            class="form-label">Ảnh mới</label>
                                                                        <input id="img" type="file" name="image"
                                                                            class="form-control hidden">
                                                                    </div>
                                                                    <p>Lưu ý: khi thêm mới, Website của bạn sẽ thay đổi</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light"
                                                                        data-bs-dismiss="modal">Hủy</button>
                                                                    <input type="hidden" name="slide_id" value="{{$slide->id}}">
                                                                    <button type="submit" class="btn btn-light">Sửa</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href=""
                                                    onclick="$('#dialog-example_{{ $slide->id }}').modal('show');"
                                                    data-toggle="modal" data-target="#exampleModal"><svg
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
                                                </a>
                                                <div id="dialog-example_{{ $slide->id }}" class="modal fade"
                                                    id="exampleModal" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div id="dialog-example_{{ $slide->id }}" class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Bạn muốn xóa
                                                                    sản phẩm slide này ?</h5>
                                                                <i class="lni lni-close" data-dismiss="modal"
                                                                    aria-label="Close"
                                                                    onclick="$('#dialog-example_{{ $slide->id }}').modal('hide');"></i>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-success"
                                                                    data-dismiss="modal"
                                                                    onclick="$('#dialog-example_{{ $slide->id }}').modal('hide');">Hủy</button>
                                                                <a href="{{ route('admin.delslide', ['id' => $slide->id]) }}"><button type="button"
                                                                        class="btn btn-danger">Xóa</button></a>
                                                            </div>
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
                    {{ $slides->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        function changeImg(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#avatar').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(document).ready(function() {
            $('#avatar').click(function() {
                $('#img').click();
            });
        });

    </script>
@endsection
