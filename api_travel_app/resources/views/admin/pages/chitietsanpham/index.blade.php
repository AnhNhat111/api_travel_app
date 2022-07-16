@extends('admin.Layouts.layoutmaster')

@section('body')

<a href="{{ route('chi-tiet-san-pham.create') }}"><button type="button" class="btn btn-success">Thêm</button></a>
<table class="table">
    <thead>
        <tr>
            <th>Mã Sản Phẩm</th>
            <th>Màu </th>
            <th>Kích cỡ</th>
            <th>Số lượng tồn</th>
            <th>Trạng thái</th>
            <th>Tùy chỉnh</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pro as $row)
        <tr>
            <td>{{$row->MASP}}</td>
            <td>{{$row->COLOR}}</td>
            <td>{{$row->SIZE}}</td>
            <td>{{$row->SLTK}}</td>
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
                        <a href="{{ route('chi-tiet-san-pham.show',$row->id) }}"><button type="button" class="btn btn-primary btn-sm">Chi tiết</button> </a>
                        <a href="{{ route('chi-tiet-san-pham.edit',$row->id) }}"><button type="button" class="btn btn-primary btn-sm">Sửa</button> </a>

                        <form action="{{ route('QLsanpham.destroy',$row->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button style="margin-left: 10px" type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
