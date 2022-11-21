<x-app-layout>
    <x-slot name="title">Wisata</x-slot>

    @if (session()->has('success'))
        <x-alert type="success" message="{{ session()->get('success') }}" />
    @endif
    <x-card>
        <x-slot name="title">List Data Wisata</x-slot>
        <x-slot name="option">
            <a href="{{ route('admin.wisata.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i>
            </a>
        </x-slot>
        <table class="table table-bordered">
            <thead>
                <th>Wisata</th>
                <th>Kelurahan</th>
                <th>Kecamatan</th>
                <th>Kabupaten</th>
                <th>Action</th>
            </thead>
            <tbody>
                @forelse($wisata as $wis)
                    <tr>
                        <td>{{ $wis->nama }}</td>
                        <td>{{ $wis->kelurahan->nama }}</td>
                        <td>{{ $wis->kecamatan->nama }}</td>
                        <td>{{ $wis->kabupaten->nama }}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-info mr-1 info" data-nama="{{ $wis->nama }}"
                                data-created="{{ $wis->created_at->format('d-M-Y H:m:s') }}"
                                data-lng="{{ $wis->lng }}" data-lat="{{ $wis->lat }}"
                                data-deskripsi="{{ $wis->deskripsi }}" data-kategori="{{ $wis->kategori->nama }}"
                                data-gambar="{{ $wis->link_sampul }}"
                                data-lokasi="{{ $wis->kelurahan->nama }}, {{ $wis->kecamatan->nama }} - {{ $wis->kabupaten->nama }}">
                                <i class="fas fa-eye"></i>
                            </button>
                            <a href="{{ route('admin.wisata.edit', $wis->id) }}" class="btn btn-primary mr-1"><i
                                    class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.wisata.delete', $wis->id) }}" style="display: inline-block;"
                                method="POST">
                                @csrf
                                <button type="button" class="btn btn-danger delete"><i
                                        class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No Data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-card>
    <x-modal>
        <x-slot name="id">infoModal</x-slot>
        <x-slot name="title">Information</x-slot>
        <div class="row mb-2">
            <div class="col-6">
                <b>KATEGORI</b>
            </div>
            <div class="col-6" id="kategori-modal"></div>
        </div>

        <div class="row mb-2">
            <div class="col-6">
                <b>Nama Wisata</b>
            </div>
            <div class="col-6" id="name-modal"></div>
        </div>

        <div class="row mb-2">
            <div class="col-6">
                <b>Lokasi</b>
            </div>
            <div class="col-6" id="lokasi-modal"></div>
        </div>

        <div class="row mb-2">
            <div class="col-6">
                <b>Latitude</b>
            </div>
            <div class="col-6" id="lat-modal"></div>
        </div>

        <div class="row mb-2">
            <div class="col-6">
                <b>Longitude</b>
            </div>
            <div class="col-6" id="lng-modal"></div>
        </div>

        <div class="row mb-2">
            <div class="col-6">
                <b>Link Gambar</b>
            </div>
            <div class="col-6" id="gambar-modal"></div>
        </div>

        <div class="row mb-2">
            <div class="col-6">
                <b>Deskripsi</b>
            </div>
            <div class="col-6" id="desk-modal"></div>
        </div>

        <div class="row mb-2">
            <div class="col-6">
                <b>Dibuat pada</b>
            </div>
            <div class="col-6" id="created-modal"></div>
        </div>
    </x-modal>

    <x-slot name="script">
        <script>
            $('.info').click(function(e) {
                e.preventDefault()

                $('#name-modal').text($(this).data('nama'))

                $('#lat-modal').text($(this).data('lat'))

                $('#lokasi-modal').text($(this).data('lokasi'))

                $('#lng-modal').text($(this).data('lng'))

                $('#desk-modal').text($(this).data('deskripsi'))

                $('#kategori-modal').text($(this).data('kategori'))

                $('#gambar-modal').text($(this).data('gambar'))

                $('#created-modal').text($(this).data('created'))

                $('#infoModal').modal('show')
            })

            $('.delete').click(function(e) {
                e.preventDefault()
                const ok = confirm('Ingin menghapus Kategori?')

                if (ok) {
                    $(this).parent().submit()
                }
            })
        </script>
    </x-slot>
</x-app-layout>
