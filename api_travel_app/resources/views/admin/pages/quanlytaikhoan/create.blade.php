<!DOCTYPE html>
<html lang="en">

@extends('admin.Layouts.layoutmaster')

@section('body')
@if ($errors->any())
	<div class="alert alert-danger alert-dismissible" role="alert">
		<ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			<span class="sr-only">Close</span>
		</button>
	</div>
@endif
    <form action="{{ route('quan-ly-tai-khoan.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
                <label for="LOAITK_ID">Loại Tài Khoản</label>
                <select class="form-control" id="LOAITK_ID" name="LOAITK_ID" required>
                    <option value="">-- Loại Tài Khoản --</option>
                    @foreach($loaitk as $loaitk)
                        <option value="{!! $loaitk->id !!}">{!! $loaitk->TENLOAITAIKHOAN !!}</option>
                    @endforeach
                </select>
            <label for="my-input">Email</label>
            <input id="my-input" required class="form-control" type="text" name="EMAIL">
            <label for="my-input">Mật khẩu</label>
            <input id="my-input" required class="form-control" type="text" name="MATKHAU">
            <label for="my-input">Tên Hiển Thị</label>
            <input id="my-input" required class="form-control" type="text" name="TENHIENTHI">
            <label for="my-input">Số điện thoại</label>
            <input id="my-input" required class="form-control" type="text" name="SODIENTHOAI">
            <label for="my-input">Địa chỉ</label>
            <input id="my-input" required class="form-control" type="text" name="DIACHI">
            <label for="my-input">Ảnh</label>
            <input id="my-input" required class="form-control" type="file" name="ANH">
            <div class="form-group">
                {{-- <div class="form-check">
                <label class="form-check-label">
                <input class="form-check-input" type="checkbox"
                id="TRANGTHAI" name="TRANGTHAI"
                />Trạng thái
                </label>
                </div> --}}
            </div>
            
        </div>
        <button name="submit" id="" class="btn btn-primary" type="submit">Thêm</button>
    </form>
@endsection