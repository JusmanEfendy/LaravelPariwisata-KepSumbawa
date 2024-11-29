<x-app-layout>
    <x-slot name="title">Verifikasi Pengajuan Wisata</x-slot>

    @if (session()->has('success'))
        <x-alert type="success" message="{{ session()->get('success') }}" />
    @endif
    <x-card>
        <x-slot name="title">Menunggu Persetujuan Wisata ...</x-slot>
        <x-slot name="option">
            <a href="{{ route('admin.data-pengajuan') }}" class="btn btn-primary">Semua Data Pengajuan</a>
        </x-slot>
        <table class="table table-bordered">
            <thead>
                <th>Nama Wisata</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th >Info Detail</th>
                <th class="text-center">Verifikasi</th>
            </thead>
            <tbody>
                @forelse($wisataApprove as $wis)
                    <tr>
                        <td>{{ $wis->nama }}</td>
                        <td>{{ $wis->kategori->nama }}</td>
                        <td>{{ $wis->kelurahan->nama }}, {{ $wis->kecamatan->nama }}, {{ $wis->kabupaten->nama }}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-info mr-1 info" data-nama="{{ $wis->nama }}"
                                data-maker="{{ $wis->user->name }}, ({{ $wis->created_at }})"
                                data-lng="{{ $wis->lng }}" data-lat="{{ $wis->lat }}"
                                data-deskripsi="{{ $wis->deskripsi }}" data-kategori="{{ $wis->kategori->nama }}"
                                data-fasilitas="{{ $wis->fasilitas }}"
                                data-lokasi="{{ $wis->kelurahan->nama }}, {{ $wis->kecamatan->nama }}, {{ $wis->kabupaten->nama }}">
                                <i class="fas fa-eye"></i>
                            Detail</button>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.pengajuan-wisata.approve', $wis->id) }}" class="btn btn-success">Setuju</a>
                            <a href="{{ route('admin.pengajuan-wisata.reject', $wis->id) }}" class="btn btn-danger">Tolak</a>
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
        <x-slot name="title">Informasi Detail</x-slot>
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
                <b>Deskripsi</b>
            </div>
            <div class="col-6" id="desk-modal"></div>
        </div>

        <div class="row mb-2">
            <div class="col-6">
                <b>Fasilitas</b>
            </div>
            <div class="col-6" id="fasilitas-modal"></div>
        </div>

        <div class="row mb-2">
            <div class="col-6">
                <b>Diajukan Oleh</b>
            </div>
            <div class="col-6" id="maker-modal"></div>
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

                $('#fasilitas-modal').text($(this).data('fasilitas'))

                $('#maker-modal').text($(this).data('maker'))

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
