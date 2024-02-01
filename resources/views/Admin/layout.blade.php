<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="{{asset('/pageuser/assets/images/icons/logo-icon.png')}}" type="image/png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đại Dương | {{ $title ?? "Dashboard" }}</title>

    @include('admin.elements.header-libs')
    <!-- Google Font: Source Sans Pro -->

</head>
<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

    <!-- Navbar -->
    @include("admin.elements.navbar")
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include("admin.elements.sidebar")
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
        @yield('content')
        <script>
            if (document.getElementById('mota')) {
                CKEDITOR.replace('mota');
            }
        </script>
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    @include("admin.elements.control-sidebar")
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    @include("admin.elements.footer")

    @include("admin.elements.alert")
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
    @include('admin.elements.footer-libs')
</body>
</html>
