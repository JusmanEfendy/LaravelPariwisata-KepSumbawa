<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Pariwisata Kepulauan Sumbawa">
    <meta name="author" content="Jussman Effendy">
    <meta name="keywords" content="pariwisata,sumbawa,kepulauan,kepulauan sumbawa,wisata sumbawa,wisata">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css"
        integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin="" />
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('dist/css/maps-style/leaflet-mouseposition.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/gokertanrisever/leaflet-ruler@master/src/leaflet-ruler.css"
        integrity="sha384-P9DABSdtEY/XDbEInD3q+PlL+BjqPCXGcF8EkhtKSfSTr/dS5PBKa9+/PMkW2xsY" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="{{ asset('dist/css/maps-style/leaflet-ruler.css') }}"> --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <link rel="stylesheet" href="{{ asset('dist/css/maps-style/map.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/maps-style/geocoder.css') }}">
</head>

<body>
    <div id="full-screen" class>
        <nav class="navbar navbar-expand-lg navbar-dark bg-nav">
            <div class="container-fluid">
                <a class="navbar-brand" href="/maps">PARIWISATA</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                    aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/maps">HOME</a>
                        </li>
                        <li class="nav-item">
                            <div class="nav-link" aria-current="page" id="route">ROUTE</div>
                        </li>
                        <select class="form-select" aria-label="Default select example"
                            onchange="searchKat(this.value)">
                            <option selected>KATEGORI</option>
                            @foreach ($kategori as $kat)
                                <option value="{{ $kat->nama }}">{{ $kat->nama }}</option>
                            @endforeach
                        </select>
                        <select class="form-select" aria-label="Default select example"
                            onchange="searchKab(this.value)">
                            <option selected>KABUPATEN</option>
                            @foreach ($kabupaten as $kab)
                                <option value="{{ $kab->nama }}">kab. {{ $kab->nama }}</option>
                            @endforeach
                        </select>
                    </ul>
                    <ul class="d-flex login">
                        <li><a href="{{ route('login') }}">LOGIN</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="detail">
            <div id="map"></div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Wisata</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btnRute btn btn-primary justify-start">Rute</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <footer class="page-footer footer blue">
            <div class="footer-copyright text-center py-3">{{ $production }}
                <a href="https://portfolio-react-jussy.vercel.app/" target="_blank"> {{ $creator }}
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js"
        integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg=" crossorigin=""></script>
    <script src="{{ asset('dist/js/maps-control/leaflet-hash.js') }}"></script>
    <script src="{{ asset('dist/js/maps-control/leaflet-mouseposition.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/gokertanrisever/leaflet-ruler@master/src/leaflet-ruler.js"
        integrity="sha384-N2S8y7hRzXUPiepaSiUvBH1ZZ7Tc/ZfchhbPdvOE5v3aBBCIepq9l+dBJPFdo1ZJ" crossorigin="anonymous">
    </script>
    {{-- <script src="{{ asset('dist/js/maps-control/leaflet-ruler.js') }}"></script> --}}
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <script src="{{ asset('dist/js/maps-control/map.js') }}"></script>
    <script src="{{ asset('dist/js/maps-control/control.geocoder.js') }}"></script>
</body>

</html>
