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
    <h1>Đây là trang tạo loại tài khoản</h1>
    <form action="{{ route('loaitaikhoan.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="my-input">Tên loại tài khoản</label>
            <input id="my-input" required class="form-control" type="text" name="TENLOAITAIKHOAN">
        </div>
        <button name="submit" id="" class="btn btn-primary" type="submit">Thêm</button>
    </form>
@endsection