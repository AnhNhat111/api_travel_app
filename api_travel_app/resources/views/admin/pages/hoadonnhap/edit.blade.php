
<!DOCTYPE html>
<html lang="en">

@extends('admin.Layouts.layoutmaster')

@section('body')
{{-- @if ($errors->any())
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
@endif --}}
    <form action="{{ route('hoadonnhap.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        {{-- <label for="my-input">ID</label>
        <input id="my-input" required class="form-control" type="text" name="MASP"> --}}

        <div class="form-group">
                <label for="MASP">Mã sản phẩm</label>
                <select class="form-control" id="SANPHAM_ID" name="SANPHAM_ID" required>
                    <option value="">-- Mã sản phẩm --</option>
                    @foreach($masp as $masp)
                        <option value="{!! $masp->id !!}">{!! $masp->MASP !!}</option>
                    @endforeach
                </select>
           
            <label for="my-input">Tài khoản nhập</label>
            <select class="form-control" id="TAIKHOAN_ID" name="TAIKHOAN_ID" required>
                <option value="">-- Tài khoản nhập --</option>
                @foreach($taikhoan as $tk)
                    <option value="{!! $tk->id !!}" >{!! $tk->TENHIENTHI !!}</option>
                @endforeach
            </select>

            <label for="my-input">Nhà cung cấp</label>
            <input id="my-input" required class="form-control" type="text" name="NHACUNGCAP">

            <label for="my-input">Số lượng</label>
            <input id="my-input" required class="form-control" type="text" name="TONGSL">

            <label for="my-input">Tổng tiền</label>
            <input id="my-input" required class="form-control" type="text" name="TONGTIEN" >

        </div>
        <button name="submit" id="" class="btn btn-primary" type="submit">Thêm</button>
    </form>
@endsection