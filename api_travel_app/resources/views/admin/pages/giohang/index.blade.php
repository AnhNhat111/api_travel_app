@extends('admin.Layouts.layoutmaster')

@section('body')
<table class="table">
    <thead>
        <tr>
            <th>Tài Khoản</th>
            <th>Sản Phẩm</th>
            <th>Số Lượng</th>
            <th>Tổng Tiền</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                <td>{{ $row->TENHIENTHI}}</td>               
                <td>{{ $row->TENSP}}</td>
                <td>{{ $row->SOLUONG}}</td>
                <td>{{ $row->TONGTIEN}}</td>

            </tr>
        @endforeach
    </tbody>
</table>
@endsection
