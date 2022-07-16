@extends('admin.Layouts.layoutmaster')

@section('body')
<table class="table">
    <thead>
        <tr>
            <th>Tài khoản</th>
            <th>Địa chỉ</th>
            <th>Ghi chú</th>
            <th>Tổng tiền</th>
            <th>Nhân viên lập</th>
            <th>Ngày lập</th>
            <th>Trạng thái</th>
            <th>Tùy chỉnh</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                <td>{{ $row->TAIKHOAN_ID}}</td>               
                <td>{{ $row->DIACHI}}</td>
                <td>{{ $row->GHICHU}}</td>
                <td>{{ $row->TONGTIEN}}</td>
                <td>{{ $row->created_at}}</td>
                <td></td>
                <td>
                    @if ($row->TRANGTHAI == 1)
                    <b class="text-success">Hoạt động</b>
                    @else
                     <b class="text-danger">Đã xóa</b>
                    @endif
                </td>
                <td class="d-inline-flex">
                    <a href=""><button type="button" class="btn btn-outline-info btn-sm">Sửa</button> </a>
                    <form action="{{ route('hoadonban.destroy',$row->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button  type="submit" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
