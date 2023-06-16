<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css"
        integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin="" />
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('dist/css/maps-style/map.css') }}">
    <link href="{{ asset('dist/img/logo/logo.png') }}" rel="shortcut icon" type="image/x-icon">
    <link href="{{ asset('dist/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dist/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dist/css/ruang-admin.min.css') }}" rel="stylesheet">
    <style>
        .maps {
            height: 100% !important;
            cursor: pointer;
        }
    </style>
    {{-- <link href="{{ asset('dist/css/map-style/leaflet-hash.js') }}" rel="stylesheet"> --}}
    {{ $head ?? '' }}
</head>

<body id="page-top">
    <div id="wrapper">

        {{-- sidebar --}}
        <x-sidebar></x-sidebar>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                {{-- topbar --}}
                <x-topbar></x-topbar>

                {{-- container fluid --}}
                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                        </ol>
                    </div>

                    {{-- Main content --}}
                    {{ $slot }}

                    {{-- Modal Logout --}}
                    <x-modal-logout />
                </div>
            </div>

            {{-- Footer --}}
            <footer class="sticky-footer bg-white mt-3">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> - developed by
                            <b><a href="https://github.com/JusmanEfendy" target="_blank">JussyCheta</a></b>
                        </span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    {{-- Scroll to top --}}
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{ asset('dist/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('dist/js/ruang-admin.min.js') }}"></script>
    <script src="{{ asset('dist/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js"
        integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg=" crossorigin=""></script>
    {{-- <script src="{{ asset('dist/js/maps-control/leaflet-hash.js') }}"></script> --}}
    <script></script>
    {{ $script ?? '' }}
</body>

</html>
