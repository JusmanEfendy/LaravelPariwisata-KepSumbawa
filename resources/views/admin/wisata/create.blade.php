<x-app-layout>
    <x-slot name="title">Tambah Wisata</x-slot>

    {{-- show alert if there is errors --}}
    <x-alert-error />

    @if (session()->has('success'))
        <x-alert type="success" message="{{ session()->get('success') }}" />
    @endif
    <x-card>
        <form action="{{ route('admin.wisata.create') }}" method="post">
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
                <div class="col-md-6">
                    <x-input text="Link Gambar" name="link_sampul" type="text"
                        aria-placeholder="Link Gambar Wisata" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <x-input text="Latitude" name="lat" type="text" aria-placeholder="Titik Wisata (latitude)" />
                </div>
                <div class="col-md-6">
                    <x-input text="Langitude" name="lng" type="text"
                        aria-placeholder="Titik Wisata (langitude)" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <x-textarea text="Deskripsi" name="deskripsi" rows="4" />
                </div>
                <div class="col-md-6">
                    <div id="map" class="maps"></div>
                </div>
            </div>
            <x-button type="primary" text="Tambah" for="submit" />
        </form>
    </x-card>
</x-app-layout>
