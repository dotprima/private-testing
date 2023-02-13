<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Simple Tables</title>

    <script type="text/javascript" nonce="8be92db4d79c4a68ab2b2058bed"
        src="//local.adguard.org?ts=1676301642634&amp;type=content-script&amp;dmn=adminlte.io&amp;pth=%2Fthemes%2Fv3%2Fpages%2Ftables%2Fsimple.html&amp;app=msedge.exe&amp;css=3&amp;js=1&amp;rel=1&amp;rji=1&amp;sbe=1&amp;stealth=1&amp;st-push&amp;st-loc&amp;st-dnt&amp;st-1pcttl=4320">
    </script>
    <script type="text/javascript" nonce="8be92db4d79c4a68ab2b2058bed"
        src="//local.adguard.org?ts=1676301642634&amp;name=AdGuard%20Extra&amp;name=AdGuard%20Popup%20Blocker&amp;type=user-script">
    </script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="../../dist/css/adminlte.min.css?v=3.2.0">
    @livewireStyles
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">


        @include('back.sidebar')

        @include('back.navbar')

        @yield('content')

        @include('back.footer')

        <aside class="control-sidebar control-sidebar-dark">

        </aside>

    </div>

    @livewireScripts
    <script src="../../plugins/jquery/jquery.min.js"></script>

    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="../../dist/js/adminlte.min.js?v=3.2.0"></script>
    <script type="text/javascript">
        function hideModal() {
            $("#tambah_keluarga").removeClass("in");
            $(".modal-backdrop").remove();
            $('body').removeClass('modal-open');
            $('body').css('padding-right', '');
            $("#tambah_keluarga").hide();
        }
        window.livewire.on('postUpdated', () => {

            $("#tambah_keluarga").hide();
            $(".modal-backdrop").remove();
        });
    </script>

<script type="text/javascript">
    function hideModal() {
        $("#update_modal").removeClass("in");
        $(".modal-backdrop").remove();
        $('body').removeClass('modal-open');
        $('body').css('padding-right', '');
        $("#update_modal").hide();
    }
    window.livewire.on('postUpdated', () => {

        $("#update_modal").hide();
        $(".modal-backdrop").remove();
    });
</script>

<script type="text/javascript">
    function hideModal() {
        $("#tambah_cucu").removeClass("in");
        $(".modal-backdrop").remove();
        $('body').removeClass('modal-open');
        $('body').css('padding-right', '');
        $("#tambah_cucu").hide();
    }
    window.livewire.on('postUpdated', () => {

        $("#tambah_cucu").hide();
        $(".modal-backdrop").remove();
    });
</script>

</body>

</html>
