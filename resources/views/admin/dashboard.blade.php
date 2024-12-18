<x-app-layout>
    <x-slot name="title">
        Dashboard
    </x-slot>

    <section class="row">
        <x-card-sum text="Total Wisata" value="{{ count($wisata) }}" icon="users" color="warning" />
        <x-card-sum text="Total Kategori Wisata" value="{{ count($kategori) }}" icon="money-bill" color="success" />
        <x-card-sum text="Total Kelurahan" value="{{ count($kelurahan) }}" icon="chart-line" color="primary" />
        <x-card-sum text="Total Kecamatan" value="{{ count($kecamatan) }}" icon="box" color="danger" />
    </section>

    <section class="row">
        {{-- log activity section --}}
        <div class="col-md-6">
            <x-card>
                <x-slot name="title">
                    Log Activity
                </x-slot>
                <x-slot name="option">
                    <a href="{{ route('admin.logs') }}" class="btn btn-primary btn-sm">More</a>
                </x-slot>
                <table class="table">
                    <tbody>
                        @forelse($logs as $log)
                            <tr>
                                <td>{{ $log->description }}</td>
                                <td><small>{{ $log->created_at->diffForHumans() }}</small></td>
                            </tr>
                        @empty
                            <td colspan="2" class="text-center">No Data</td>
                        @endforelse
                    </tbody>
                </table>
            </x-card>
        </div>

        {{-- chart section --}}
        <div class="col-md-6">
            <!-- Area Charts -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Peta Kepulauan Sumbawa</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <div id="map" class="maps"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-slot name="script">
        <script src="{{ asset('dist/js/maps-control/map.js') }}"></script>
        {{-- <script src="{{ asset('dist/js/demo/chart-area-demo.js') }}"></script> --}}
    </x-slot>
</x-app-layout>
