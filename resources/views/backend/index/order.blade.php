<div class="card radius-10">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div>
                <h5 class="mb-0">Đơn hàng chưa hoàn thành</h5>
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
                        <th>Khách hàng</th>
                        <th>Tổng tiền</th>
                        <th>Ngày</th>
                        <th>Tình trạng</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key => $item)
                        <tr>
                            <td>#{{$key+1 }}</td>
                            <td>
                                {{ $item->name }}
                            </td>
                            <td>{{ number_format($item->total) }} VNĐ</td>
                            <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                            <td>
                                <span style="background: rgb(214, 12, 29)" class="badge badge-danger">Chưa xử lý</span>
                            </td>
                            <td>
                                <div class="d-flex order-actions">
                                    <a href="{{ route('admin_order_detail', ['id' => $item->id, 'name' => $item->slug]) }}"
                                        class=""><i class='bx bxs-edit'></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

        </div>
    </div>
</div>
