@extends('admin.Layouts.layoutmaster')

@section('body')

@if ( Session::has('success') )
	<div class="alert alert-success alert-dismissible" role="alert">
		<strong>{{ Session::get('success') }}</strong>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			<span class="sr-only">Close</span>
		</button>
	</div>
@endif
@if ( Session::has('error') )
	<div class="alert alert-danger alert-dismissible" role="alert">
		<strong>{{ Session::get('error') }}</strong>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			<span class="sr-only">Close</span>
		</button>
	</div>
@endif
<a href="{{ route('quan-ly-tai-khoan.create') }}"><button type="button" class="btn btn-success">Thêm</button></a>
<div style="overflow: :auto">
    <table class="table" >
        <thead>
            <tr style="align-items: center">
                <th>Loại Tài Khoản</th>
                <th>Tên Hiển Thị</th>
                <th>SDT</th>    
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>Ảnh</th>
                <th>Trạng thái</th>
                <th>Tình trạng</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($tk as $user )
                <tr>
                    <td>{{ $user->TENLOAITAIKHOAN }}</td>
                    
                    <td>{{ $user->TENHIENTHI }}</td>
                    <td>{{ $user->SODIENTHOAI }}</td>
                    <td>{{ $user->email}}</td>
                    <td>{{ $user->DIACHI}}</td>
                    <td>
                        <img alt="{{ $user->TENHIENTHI }}" src={{ asset('upload/avatar/' . $user->ANH  ) }} style="text-align: center; vertical-align: middle; width: 60px;">
                    </td>
                    {{-- <td>{{ $user->TRANGTHAI }}</td> --}}
                    <td class="text-center">
                        @if ($user->TRANGTHAI == 1)
                        
                        <span class="badge badge-
                        success">Yes</span>
                        
                        @else
                        
                        <span class="badge badge-
                        danger">No</span>
                        
                        @endif
                        </td>
                    <td class="d-inline-flex">
                        <a href="{{ route('quan-ly-tai-khoan.edit',$user->id) }}"><button type="button" class="btn btn-primary btn-sm">Sửa</button> </a>
                        <form action="{{ route('quan-ly-tai-khoan.destroy',$user->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button style="margin-left: 10px" type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            @foreach ($ad as $admin )
            <tr>
                <td>{{ $admin->TENLOAITAIKHOAN }}</td>
                
                <td>{{ $admin->TENHIENTHI }}</td>
                <td>{{ $admin->SODIENTHOAI }}</td>
                <td>{{ $admin->email}}</td>
                <td>{{ $admin->DIACHI}}</td>
                <td>
                    <img alt="{{ $admin->TENHIENTHI }}" src={{ asset('upload/avatar/' . $admin->ANH  ) }} style="text-align: center; vertical-align: middle; width: 60px;">
                </td>
                {{-- <td>{{ $user->TRANGTHAI }}</td> --}}
                <td class="text-center">
                    @if ($admin->TRANGTHAI == 1)
                    
                    <span class="badge badge-
                    success">Yes</span>
                    
                    @else
                    
                    <span class="badge badge-
                    danger">No</span>
                    
                    @endif
                    </td>
                <td class="d-inline-flex">
                    <a href="{{ route('quan-ly-tai-khoan.edit',$admin->id) }}"><button type="button" class="btn btn-primary btn-sm">Sửa</button> </a>
                    <form action="{{ route('quan-ly-tai-khoan.destroy',$admin->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button  type="submit" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
           
        </tbody>
    </table>
</div>
@endsection
