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

        <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                    </ol>
                </div>
            </div>


            <div class="container-fluid">
                <!--Phần thân của tamplate-->
            @show
            @yield('body')
        </div>
    </div>
    <!--Footer-->
    @include('admin.Layouts.Includes.footer')


</div>

<script src="assets/admin/plugins/common/common.min.js"></script>
<script src="assets/admin/js/custom.min.js"></script>
<script src="assets/admin/js/settings.js"></script>
<script src="assets/admin/js/gleek.js"></script>
<script src="assets/admin/js/styleSwitcher.js"></script>

</body>

</html>
