@extends('admin.Layouts.layoutmaster')

@section('body')

<a href="{{ route('hoadonnhap.create') }}"><button type="button" class="btn btn-success">Thêm</button></a>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tài khoản nhập</th>
            <th>Mã sản phẩm</th>
            <th>Nhà cung cấp</th>
            <th>Tổng số lượng</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Tùy chỉnh</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pro as $row)
        <tr>
            <td>{{$row->id}}</td>
            <td>{{$row->TAIKHOAN_ID}}</td>
            <td>{{$row->MASP}}</td>
            <td>{{$row->NHACUNGCAP}}</td>
            <td>{{$row->TONGSL}}</td>
            <td>{{$row->TONGTIEN}}</td>
                <td class="text-center">
                    @if ($row->TRANGTHAI == 1)

                    <span class="badge badge-
                    success">Yes</span>

                    @else

                    <span class="badge badge-
                    danger">No</span>

                    @endif
                 </td>
            <td class="d-inline-flex">
                <a href=""><button type="button" class="btn btn-primary btn-sm">Chi tiết</button> </a>
                <a href=""><button type="button" class="btn btn-primary btn-sm">Sửa</button> </a>
                <form action="{{ route('hoadonnhap.destroy',$row->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
