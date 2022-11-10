<x-app-layout>
    <x-slot name="title">Edit Kategori</x-slot>

    {{-- show alert if there is errors --}}
    <x-alert-error />

    <x-card>
        <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <x-input text="Nama Kategori" name="nama" type="text" value="{{ $kategori->nama }}" />
                </div>
            </div>
            <x-button type="primary" text="Ubah" for="submit" />
        </form>
    </x-card>
</x-app-layout>
