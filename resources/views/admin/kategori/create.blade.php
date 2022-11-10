<x-app-layout>
    <x-slot name="title">Tambah Kategori</x-slot>

    {{-- show alert if there is errors --}}
    <x-alert-error />

    @if (session()->has('success'))
        <x-alert type="success" message="{{ session()->get('success') }}" />
    @endif
    <x-card>
        <form action="{{ route('admin.kategori.create') }}" method="post">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <x-input text="Nama Kategori" name="nama" type="text" />
                </div>

            </div>

            <x-button type="primary" text="Tambah" for="submit" />

        </form>
    </x-card>
</x-app-layout>
