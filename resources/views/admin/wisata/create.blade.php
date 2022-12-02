<x-app-layout>
    <x-slot name="title">Tambah Wisata</x-slot>

    {{-- show alert if there is errors --}}
    <x-alert-error />

    @if (session()->has('success'))
        <x-alert type="success" message="{{ session()->get('success') }}" />
    @endif
    <x-card>
        <form action="{{ route('admin.wisata.create') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <x-input text="Nama Wisata" name="nama" type="text" />
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Kategori</label>
                        <select name="id_kategori" class="form-control">
                            <option selected>--- Pilih Kategori ---</option>
                            @foreach ($kat as $val)
                                <option value="{{ $val->id }}">{{ $val->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Kabupaten</label>
                        <select name="id_kabupaten" class="form-control">
                            <option selected>--- Pilih Kabupaten ---</option>
                            @foreach ($kab as $val)
                                <option value="{{ $val->id }}">{{ $val->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Kecamatan</label>
                        <select name="id_kecamatan" class="form-control">
                            <option selected>--- Pilih Kecamatan ---</option>
                            @foreach ($kec as $val)
                                <option value="{{ $val->id }}">{{ $val->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Kelurahan</label>
                        <select name="id_kelurahan" class="form-control">
                            <option selected>--- Pilih Kelurahan ---</option>
                            @foreach ($kel as $val)
                                <option value="{{ $val->id }}">{{ $val->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- <div class="col-md-6">
                    <x-input text="Link Gambar" name="link_sampul" type="text"
                        aria-placeholder="Link Gambar Wisata" />
                </div> --}}
                <div class="col-md-6 mt-4">
                    <div class="input-group mb-3">
                        <input type="file"
                            class="form-control @error('link_sampul')
                        is-invalid       
                        @enderror"
                            id="link_sampul" name="link_sampul">
                        @error('link_samapul')
                            <div class="invalid_feedback">{{ $message }}</div>
                        @enderror
                        <label class="input-group-text" for="link_sampul">Upload</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <x-input text="Latitude" id="lat" name="lat" type="text"
                        aria-placeholder="Titik Wisata (latitude)" />
                </div>
                <div class="col-md-6">
                    <x-input text="Longitude" name="lng" id="lng" type="text"
                        aria-placeholder="Titik Wisata (longitude)" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <x-textarea text="Deskripsi" name="deskripsi" rows="4" />
                </div>
                <div class="col-md-6">
                    <label for="map">Click map for to get latitude and longitude</label>
                    <div id="map" class="maps"></div>
                </div>
            </div>
            <x-button type="primary" text="Tambah" for="submit" />
        </form>
    </x-card>
    <x-slot name="script">
        <script>
            const map = L.map('map').setView([-8.6327874, 117.6065781], 8);
            const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            map.on('click', function(e) {
                $("#lat").val(e.latlng.lat);
                $('input[name=lat]').val(e.latlng.lat)
                $("#lng").val(e.latlng.lng);
                $('input[name=lng]').val(e.latlng.lng)
                let newMarker = new L.marker(e.latlng).addTo(map);
            })
        </script>
    </x-slot>
</x-app-layout>
