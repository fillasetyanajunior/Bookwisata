<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title')</title>
<meta name="csrf-token" content="{{csrf_token()}}">

<link rel="shortcut icon" type="image/x-icon" href="{{url('assets/utama/img/icon/icon.png')}}">
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{url('assets/plugins/fontawesome-free/css/all.min.css')}}">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{url('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
<!-- iCheck -->
<link rel="stylesheet" href="{{url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<!-- JQVMap -->
<link rel="stylesheet" href="{{url('assets/plugins/jqvmap/jqvmap.min.css')}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{url('assets/dist/css/adminlte.min.css')}}">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{url('assets/plugins/daterangepicker/daterangepicker.css')}}">
<!-- summernote -->
<link rel="stylesheet" href="{{url('assets/plugins/summernote/summernote-bs4.min.css')}}">
<link rel="stylesheet" href="{{url('assets/dist/css/style.css')}}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<!-- Preloader -->
<div class="preloader">
    <img src="{{url('assets/utama/img/icon/icon.png')}}" alt="AdminLTELogo" height="60" width="60">
</div>


@yield('main')

<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright &copy;
        <script>
            document.write(new Date().getFullYear());
        </script>
        <a href="https://adminlte.io">Bookwisata.com</a>.
    </strong>
    By Filla Jr
    </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{url('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{url('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{url('assets/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
{{-- <script src="{{url('assets/plugins/sparklines/sparkline.js')}}"></script> --}}
<!-- JQVMap -->
<script src="{{url('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{url('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{url('assets/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{url('assets/plugins/moment/moment.min.js')}}"></script>
<script src="{{url('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{url('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{url('assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('assets/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('assets/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="{{url('assets/dist/js/pages/dashboard.js')}}"></script> --}}
<script src="{{url('assets/dist/js/kota.js')}}"></script>
<script src="{{url('assets/dist/js/add.js')}}"></script>
<script src="{{url('assets/dist/js/countdown.js')}}"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script language="javascript" type="text/javaScript">

$(document).ready(function () {
    var pusher = new Pusher('58dff3dcd7642b8137a0', {
    cluster: 'ap1'
    });
    var chacking = $('.id_user').attr('content')

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        var existing = $('.dropdown .dropdown-menu').html();
        var ncount = $('.dropdown .countNotif').html();
        var notifcount = parseInt(ncount);
        var html='';
        if (data.ids == chacking) {
        if(data){

            html +=' <a class="dropdown-item" href="/riwayat">' + data.messages + '</a>';

            notifcount +=1;
            $('.dropdown .countNotif').text(notifcount);
            var newNotifHtml = html + existing;
            $('.dropdown .dropdown-menu').html(newNotifHtml);
        }
        } else {

        }

    });
    });
</script>
</body>
</html>
