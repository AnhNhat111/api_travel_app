<!DOCTYPE html>
<html lang="en">

<head>
    <base href="{{ asset('/') }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Trang admin</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/admin/images/favicon.png') }}">
    <!-- Custom Stylesheet -->
    <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet">
    <!-- CSS only -->
    <link href="{{ asset('assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://kit.fontawesome.com/1d0dc93f6d.js" crossorigin="anonymous"></script>
</head>

<body>

    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3"
                    stroke-miterlimit="10" />
            </svg>
        </div>
    </div>

    <div id="main-wrapper">

        <!--Đây là headder bên phải-->
        @include('admin.Layouts.Includes.nav-header')


        <!--Đây là header trên cùng-->
        @include('admin.Layouts.Includes.header')


        <!--Đây là sidebar-->
        @include('admin.Layouts.Includes.sidebar')

        <div class="content-body" style="min-height: 1000px">
            <div class="container-fluid">
                <!--Phần thân của tamplate-->
            @show
            @yield('body')
        </div>
    </div>
    <!--Footer-->
    @include('admin.Layouts.Includes.footer')


</div>

<script src="{{ asset('assets/admin/plugins/common/common.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/custom.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/settings.js') }}"></script>
<script src="{{ asset('assets/admin/js/gleek.js') }}"></script>
<script src="{{ asset('assets/admin/js/styleSwitcher.js') }}"></script>

<script src="{{ asset('assets/admin/plugins/tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
</body>

</html>
