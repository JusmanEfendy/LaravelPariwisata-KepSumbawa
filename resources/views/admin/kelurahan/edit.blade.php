<x-app-layout>
    <x-slot name="title">Edit Kelurahan</x-slot>

    {{-- show alert if there is errors --}}
    <x-alert-error />

    <x-card>
        <form action="{{ route('admin.kelurahan.update', $kelurahan->id) }}" method="post">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <x-input text="Nama Kelurahan" name="nama" type="text" value="{{ $kelurahan->nama }}" />
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
                    {{-- <x-select text="Kecamatan" name="id_kecamatan" :values="$kecamatan" multiple="true" /> --}}
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
                    {{-- <x-select text="Kabupaten" name="id_kabupaten" :values="$kabupaten" multiple="true" /> --}}
                </div>
            </div>
            <x-button type="primary" text="Ubah" for="submit" />

        </form>
    </x-card>
</x-app-layout>
