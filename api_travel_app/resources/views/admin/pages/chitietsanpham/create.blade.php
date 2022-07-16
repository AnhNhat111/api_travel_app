
<!DOCTYPE html>
<html lang="en">

@extends('admin.Layouts.layoutmaster')

@section('body')
    <form action="{{ route('chi-tiet-san-pham.store') }}" method="post">
        @csrf
        <div class="form-group">
                <label for="MASP">Mã sản phẩm</label>
                <select class="form-control" id="SANPHAM_ID" name="SANPHAM_ID" required>
                    <option value="">-- Mã sản phẩm --</option>
                    @foreach($masp as $masp)
                        <option value="{!! $masp->id !!}">{!! $masp->MASP !!}</option>
                    @endforeach
                </select>

            <label for="my-input">Giá bán</label>
            <input id="my-input" required class="form-control" type="text" name="GIABAN">

            <label for="my-input">Số lượng tồn</label>
            <input id="my-input" required class="form-control" type="text" name="SLTK">

            <label for="my-input">Màu</label>
            <input id="my-input" required class="form-control" type="text" name="COLOR">

            <label for="my-input">Size</label>
            <input id="my-input" required class="form-control" type="text" name="SIZE">


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