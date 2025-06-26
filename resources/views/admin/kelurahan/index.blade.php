<x-app-layout>
    <x-slot name="title">Data Kelurahan</x-slot>

    @if (session()->has('success'))
        <x-alert type="success" message="{{ session()->get('success') }}" />
    @endif
    <x-card>
        <x-slot name="title">List Data Kelurahan</x-slot>
        <x-slot name="option">
            <a href="{{ route('admin.kelurahan.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i>
            </a>
        </x-slot>
        <table class="table table-bordered">
            <thead>
                <th>Kelurahan</th>
                <th>Kecamatan</th>
                <th>Kabupaten</th>
                <th>Action</th>
            </thead>
            <tbody>
                @forelse($kelurahan as $kel)
                    <tr>
                        <td>{{ $kel->nama }}</td>
                        <td>{{ $kel->kecamatan->nama }}</td>
                        <td>{{ $kel->kabupaten->nama }}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-info mr-1 info" data-name="{{ $kel->nama }}"
                                data-created="{{ $kel->created_at->format('d-M-Y H:m:s') }}"
                                data-kecamatan="{{ $kel->kecamatan->nama }}"
                                data-kabupaten="{{ $kel->kabupaten->nama }}">
                                <i class="fas fa-eye"></i>
                            </button>
                            <a href="{{ route('admin.kelurahan.edit', $kel) }}" class="btn btn-primary mr-1"><i
                                    class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.kelurahan.delete', $kel->id) }}"
                                style="display: inline-block;" method="POST">
                                @csrf
                                <button type="button" class="btn btn-danger delete"><i
                                        class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Tidak ada Data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-4">
            {{ $kelurahan->links() }}
        </div>
    </x-card>
    <x-modal>
        <x-slot name="id">infoModal</x-slot>
        <x-slot name="title">Information</x-slot>
        <div class="row mb-2">
            <div class="col-6">
                <b>Nama Kelurahan</b>
            </div>
            <div class="col-6" id="name-modal"></div>
        </div>

        <div class="row mb-2">
            <div class="col-6">
                <b>Kecamatan</b>
            </div>
            <div class="col-6" id="kec-modal"></div>
        </div>

        <div class="row mb-2">
            <div class="col-6">
                <b>Kabupaten</b>
            </div>
            <div class="col-6" id="kab-modal"></div>
        </div>
        <div class="row mb-2">
            <div class="col-6">
                <b>Created</b>
            </div>
            <div class="col-6" id="created-modal"></div>
        </div>
    </x-modal>
    <x-slot name="script">
        <script>
            $('.info').click(function(e) {
                e.preventDefault()

                $('#name-modal').text($(this).data('name'))

                $('#kec-modal').text($(this).data('kecamatan'))

                $('#kab-modal').text($(this).data('kabupaten'))

                $('#created-modal').text($(this).data('created'))

                $('#infoModal').modal('show')
            })

            $('.delete').click(function(e) {
                e.preventDefault()
                const ok = confirm('Ingin menghapus Kelurahan?')

                if (ok) {
                    $(this).parent().submit()
                }
            })
        </script>
    </x-slot>
</x-app-layout>
