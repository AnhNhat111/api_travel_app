@extends('admin.Layouts.layoutmaster')

@section('body')
<h1>Đây là trang sửa chi tiết sản phẩm</h1>
<form action="{{ route('chi-tiet-san-pham.update',$ctsp[0]->id) }}" method="post">
    @csrf
    @method('put')
    <div class="form-group">
        
        <label for="my-input">Số lượng tồn</label>
        <input id="my-input" required class="form-control" type="text" name="SLTK" value="{{ $ctsp[0]->SLTK }}">

        <label for="my-input">Màu</label>
        <input id="my-input" required class="form-control" type="text" name="COLOR" value="{{ $ctsp[0]->COLOR }}">

        <label for="my-input">Size</label>
        <input id="my-input" required class="form-control" type="text" name="SIZE" value="{{ $ctsp[0]->SIZE }}">

            <div class="form-group">
                <div class="form-check">
                <label class="form-check-label">
                <input class="form-check-input" type="checkbox"
                id="TRANGTHAI" name="TRANGTHAI"
                {{ $ctsp[0]->TRANGTHAI == 1 ? 'checked' : ''}}
                />Trạng thái
                </label>
                </div>
            </div>
    </div>
        <button name="submit" id="" class="btn btn-primary" type="submit">Sửa</button>
</form>   
@endsection