@extends('admin.Layouts.layoutmaster')

@section('body')

    <form action="{{ route('loaisp.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="my-input">Tên loại sản phẩm</label>
            <input id="my-input" required class="form-control" type="text" name="TENLOAISP">
        </div>
        <button name="submit" id="" class="btn btn-primary" type="submit">Thêm</button>
    </form>
@endsection