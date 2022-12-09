<x-app-layout>
    <x-slot name="title">Edit Wisata</x-slot>
    {{-- show alert if there is errors --}}
    <x-alert-error />
    <x-card>
        <form action="{{ route('admin.wisata.update', $wisata->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <x-input text="Nama Wisata" name="nama" type="text" value="{{ $wisata->nama }}" />
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Kategori</label>
                        <select name="id_kategori" class="form-control">
                            @foreach ($kategori as $key => $val)
                                <option value="{{ $val->id }}" {{ $kat->id == $val->id ? 'selected' : '' }}>
                                    {{ $val->nama }}</option>
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
                            @foreach ($kabupaten as $key => $val)
                                <option value="{{ $val->id }}" {{ $kab->id == $val->id ? 'selected' : '' }}>
                                    {{ $val->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Kecamatan</label>
                        <select name="id_kecamatan" class="form-control">
                            @foreach ($kecamatan as $key => $val)
                                <option value="{{ $val->id }}" {{ $kec->id == $val->id ? 'selected' : '' }}>
                                    {{ $val->nama }}</option>
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
                            @foreach ($kelurahan as $key => $val)
                                <option value="{{ $val->id }}" {{ $kab->id == $val->id ? 'selected' : '' }}>
                                    {{ $val->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <x-input text="Link Gambar" name="link_sampul" type="text" value="{{ $wisata->link_sampul }}" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <x-input text="Latitude" id="lat" name="lat" type="text"
                        value="{{ $wisata->lat }}" />
                </div>
                <div class="col-md-6">
                    <x-input text="Longitude" id="lng" name="lng" type="text"
                        value="{{ $wisata->lng }}" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <x-textarea text="Deskripsi" name="deskripsi" rows="4" value="{{ $wisata->deskripsi }}" />
                </div>
                <div class="col-md-6">
                    <label for="map">Click map for to get latitude and longitude</label>
                    <div id="map" class="maps"></div>
                </div>
            </div>
            <x-button type="primary" text="Ubah" for="submit" />
        </form>
    </x-card>
    <x-slot name="script">
        <script>
            const map = L.map('map').setView([-8.6327874, 117.6065781], 8);
            const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            const lat = "{{ $wisata->lat }}";
            const lng = "{{ $wisata->lng }}";
            let awalMarker = new L.marker([parseFloat(lat), parseFloat(lng)]).addTo(map)

            map.on('click', function(e) {
                map.removeLayer(awalMarker)
                $('input[name=lat]').val(e.latlng.lat)
                $('input[name=lng]').val(e.latlng.lng)
                let newMarker = new L.marker(e.latlng).addTo(map)
            })
        </script>
    </x-slot>
</x-app-layout>
