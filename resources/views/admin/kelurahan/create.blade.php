<x-app-layout>
    <x-slot name="title">Tambah Kelurahan</x-slot>

    {{-- show alert if there is errors --}}
    <x-alert-error />

    @if (session()->has('success'))
        <x-alert type="success" message="{{ session()->get('success') }}" />
    @endif
    <x-card>
        <form action="{{ route('admin.kelurahan.create') }}" method="post">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <x-input text="Nama Kelurahan" name="nama" type="text" />
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
                        <label for="">Kabupaten</label>
                        <select name="id_kabupaten" class="form-control">
                            <option selected>--- Pilih Kabupaten ---</option>
                            @foreach ($kab as $val)
                                <option value="{{ $val->id }}">{{ $val->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <x-button type="primary" text="Tambah" for="submit" />
        </form>
    </x-card>
</x-app-layout>
