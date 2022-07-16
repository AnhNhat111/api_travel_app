@extends('admin.Layouts.layoutmaster')

@section('body')
<h1>Đây là trang sửa loại sản phẩm</h1>
<form action="{{ route('loaisp.update',$id) }}" method="post">
    @csrf
    @method('put')
    <div class="form-group">
            <label for="my-input">Tên loại sản phẩm</label>
            <input id="my-input" required class="form-control" type="text" name="TENLOAISP" value="{{ $data->TENLOAISP }}">
        </div>
        <button name="submit" id="" class="btn btn-primary" type="submit">Sửa</button>
</form>
@endsection