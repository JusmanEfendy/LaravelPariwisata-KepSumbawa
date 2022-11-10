<x-app-layout>
    <x-slot name="title">Edit Kabupaten</x-slot>

    {{-- show alert if there is errors --}}
    <x-alert-error />

    <x-card>
        <form action="{{ route('admin.kabupaten.update', $kabupaten->id) }}" method="post">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <x-input text="Nama Kabupaten" name="nama" type="text" value="{{ $kabupaten->nama }}" />
                </div>
            </div>
            <x-button type="primary" text="Ubah" for="submit" />

        </form>
    </x-card>
</x-app-layout>
