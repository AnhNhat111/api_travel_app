@extends('admin.Layouts.layoutmaster')

@section('body')
<h1>Đây là trang sửa loại tài khoản</h1>
<form action="{{ route('loaitaikhoan.update',$id) }}" method="post">
    @csrf
    @method('put')
    <div class="form-group">
            <label for="my-input">Tên loại tài khoản</label>
            <input id="my-input" required class="form-control" type="text" name="TENLOAITAIKHOAN" value="{{ $data-> TENLOAITAIKHOAN}}">
        </div>
        <button name="submit" id="" class="btn btn-primary" type="submit">Sửa</button>
</form>
@endsection