<x-app-layout>
    <x-slot name="title">Edit Wisata</x-slot>
    {{-- show alert if there is errors --}}
    <x-alert-error />
    <x-card>
        <form action="{{ route('admin.wisata.update', $wisata->id) }}" method="post">
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
                    <x-input text="Latitude" name="lat" type="text" value="{{ $wisata->lat }}" />
                </div>
                <div class="col-md-6">
                    <x-input text="Langitude" name="lng" type="text" value="{{ $wisata->lng }}" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <x-textarea text="Deskripsi" name="deskripsi" rows="4" value="{{ $wisata->deskripsi }}" />
                </div>
            </div>
            <x-button type="primary" text="Ubah" for="submit" />
        </form>
    </x-card>
</x-app-layout>
