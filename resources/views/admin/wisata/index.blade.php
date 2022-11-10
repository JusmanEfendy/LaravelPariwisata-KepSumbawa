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
                <th>Kategori</th>
                <th>Kelurahan</th>
                <th>Kecamatan</th>
                <th>Kabupaten</th>
                <th>lat</th>
                <th>lng</th>
                <th>Deskripsi</th>
                <th>Action</th>
            </thead>
            <tbody>
                @forelse($wisata as $wis)
                    <tr>
                        <td>{{ $wis->nama }}</td>
                        <td>{{ $wis->kategori->nama }}</td>
                        <td>{{ $wis->kelurahan->nama }}</td>
                        <td>{{ $wis->kecamatan->nama }}</td>
                        <td>{{ $wis->kabupaten->nama }}</td>
                        <td>{{ $wis->lat }}</td>
                        <td>{{ $wis->lng }}</td>
                        <td>{{ $wis->deskripsi }}</td>

                        <td class="text-center">
                            <button type="button" class="btn btn-info mr-1 info" data-name="{{ $wis->nama }}"
                                data-created="{{ $wis->created_at->format('d-M-Y H:m:s') }}">
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
                <b>Name Wisata</b>
            </div>
            <div class="col-6" id="name-modal"></div>
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

                $('#name-modal').text($(this).data('name'))

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
