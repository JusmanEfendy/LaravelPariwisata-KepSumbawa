<x-app-layout>
    <x-slot name="title">Kategori</x-slot>

    @if (session()->has('success'))
        <x-alert type="success" message="{{ session()->get('success') }}" />
    @endif
    <x-card>
        <x-slot name="title">List Data Kategori</x-slot>
        <x-slot name="option">
            <a href="{{ route('admin.kategori.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i>
            </a>
        </x-slot>
        <table class="table table-bordered">
            <thead>
                <th>Kategori</th>
                <th>Action</th>
            </thead>
            <tbody>
                @forelse($kategori as $kat)
                    <tr>
                        <td>{{ $kat->nama }}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-info mr-1 info" data-name="{{ $kat->nama }}"
                                data-created="{{ $kat->created_at->format('d-M-Y H:m:s') }}">
                                <i class="fas fa-eye"></i>
                            </button>
                            <a href="{{ route('admin.kategori.edit', $kat->id) }}" class="btn btn-primary mr-1"><i
                                    class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.kategori.delete', $kat->id) }}" style="display: inline-block;"
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
                <b>Name Kategori</b>
            </div>
            <div class="col-6" id="name-modal"></div>
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
