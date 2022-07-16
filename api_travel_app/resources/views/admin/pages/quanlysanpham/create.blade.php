
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
    <form action="{{ route('QLsanpham.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
                <label for="LOAISP_ID">Loại sản phẩm</label>
                <select class="form-control" id="LOAISP_ID" name="LOAISP_ID" required>
                    <option value="">-- Loại sản phẩm --</option>
                    @foreach($loaisp as $loaisp)
                        <option value="{!! $loaisp->id !!}">{!! $loaisp->TENLOAISP !!}</option>
                    @endforeach
                </select>
            <label for="my-input">Mã sản phẩm</label>
            <input id="my-input" required class="form-control" type="text" name="MASP">

            <label for="my-input">Tên sản phẩm</label>
            <input id="my-input" required class="form-control" type="text" name="TENSP">

            <label for="my-input">Giá bán</label>
            <input id="my-input" required class="form-control" type="text" name="GIABAN">

            <label for="my-input">Mô tả</label>
            <input id="my-input" required class="form-control" type="text" name="MOTA">

            <label for="my-input">Ảnh</label>
            <input id="my-input" required class="form-control" type="file" name="HINHANH">


            {{-- <label for="SIZE">Kích cỡ</label>
            <select class="form-control" id="SIZE" name="SIZE" required>
                <option value="" name="SIZE">-- Size --</option>
                <option value="" name="SIZE">S</option>
                <option value="" name="SIZE">M</option>
                <option value="" name="SIZE">L</option>
                <option value="" name="SIZE">XL</option>
            </select> --}}
            
        </div>
        <button name="submit" id="" class="btn btn-primary" type="submit">Thêm</button>
    </form>
@endsection