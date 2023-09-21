<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ asset('admin/vendors/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('admin/vendors/font-awesome/css/font-awesome.min.css') }}"> -->
    <!-- <link rel="stylesheet" href="{{ asset('admin/vendors/Ionicons/css/ionicons.min.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('admin/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/skins/_all-skins.min.css') }}">

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="hold-transition skin-blue sidebar-mini">
    @inertia

    <script src="{{ asset('admin/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- <script src="{{ asset('admin/vendors/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script> -->
    <!-- <script src="{{ asset('admin/vendors/fastclick/lib/fastclick.js') }}"></script> -->
    <script src="{{ asset('admin/js/adminlte.min.js') }}"></script>
    <!-- <script src="{{ asset('admin/js/demo.js') }}"></script> -->
    <!-- <script>
        $(document).ready(function() {
            $('.sidebar-menu').tree()
        })
    </script> -->
</body>

</html>