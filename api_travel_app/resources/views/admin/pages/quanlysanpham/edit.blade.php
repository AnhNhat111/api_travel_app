@extends('admin.Layouts.layoutmaster')

@section('body')

<form action="{{ route('QLsanpham.update',$sp[0]->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="form-group">
        <label for="">Loại sản phẩm</label>
        <select class="form-control" id="LOAISP_ID" name="LOAISP_ID" required>
            <option value="">-- Loại sản phẩm --</option>
            @foreach($loaisp as $lsp)
                <option value="{!! $lsp->id !!}" {!! ($sp[0]->id == $lsp->id) ? 'selected="selected"' : null !!}>{!! $lsp->TENLOAISP !!}</option>
            @endforeach
        </select>
        <label for="my-input">Tên sản phẩm</label>
        <input id="my-input" required class="form-control" type="text" name="TENSP" value="{{ $sp[0]->TENSP }}">

        <label for="my-input">Giá bán</label>
        <input id="my-input" required class="form-control" type="text" name="GIABAN" value="{{ $sp[0]->GIABAN }}">

        <label for="my-input">Mô tả</label>
        <input id="my-input" required class="form-control" type="text" name="MOTA" value="{{ $sp[0]->MOTA }}">

        <label for="Ảnh">Chọn ảnh</label>
        <input type="file" class="form-control" id="ANH"  name="HINHANH"/>

       

            <div class="form-group">
                <div class="form-check">
                <label class="form-check-label">
                <input class="form-check-input" type="checkbox"
                id="TRANGTHAI" name="TRANGTHAI"
                {{ $sp[0]->TRANGTHAI == 1 ? 'checked' : ''}}
                />Trạng thái
                </label>
                </div>
            </div>
    </div>
        <button name="submit" id="" class="btn btn-primary" type="submit">Sửa</button>
</form>
@endsection