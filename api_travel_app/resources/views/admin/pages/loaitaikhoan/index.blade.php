@extends('admin.Layouts.layoutmaster')

@section('body')
<h1>Đây là trang quản lý loại tài khoản</h1>
<a href="{{ route('loaitaikhoan.create') }}"><button type="button" class="btn btn-success ">Thêm</button></a>
<table class="table">
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên loại tài khoản</th>
            <th>Ngày tạo</th>
            <th>Ngày sửa</th>
            <th>Tùy Chỉnh</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                <td>{{ $row->id}}</td>               
                <td>{{ $row->TENLOAITAIKHOAN}}</td>
                <td>{{ $row->created_at}}</td>
                <td>{{ $row->updated_at}}</td>
                <td class="d-inline-flex">
                    <a href="{{ route('loaitaikhoan.edit',$row->id) }}"><button type="button" class="btn btn-outline-info btn-sm">Sửa</button> </a>
                    <form action="{{ route('loaitaikhoan.destroy',$row->id) }}" method="POST">
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
