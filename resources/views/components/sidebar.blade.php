<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon">
            <img src="{{ asset(setting('logo') ? '/storage/' . setting('logo') : 'dist/img/logo/logo2.png') }}">
        </div>
        <div class="sidebar-brand-text mx-3">Pariwisata</div>
    </a>
    <hr class="sidebar-divider my-0">

    <x-nav-link text="Dashboard" icon="tachometer-alt" url="{{ route('admin.dashboard') }}"
        active="{{ request()->routeIs('admin.dashboard') ? ' active' : '' }}" />

    <hr class="sidebar-divider mb-0">

    {{-- @can('member-list')
        <x-nav-link text="Admin" icon="male" url="{{ route('admin.member') }}"
            active="{{ request()->routeIs('admin.member') ? ' active' : '' }}" />
    @endcan --}}

    @can('member-list')
        <x-nav-link text="User" icon="users" url="{{ route('admin.member') }}"
            active="{{ request()->routeIs('admin.member') ? ' active' : '' }}" />
    @endcan

    @can('kategori-list')
        <x-nav-link text="Kategori" icon="archive" url="{{ route('admin.kategori') }}"
            active="{{ request()->routeIs('admin.kategori') ? ' active' : '' }}" />
    @endcan

    @can('wisata-list')
        <x-nav-link text="Wisata" icon="compass" url="{{ route('admin.wisata') }}"
            active="{{ request()->routeIs('admin.wisata') ? ' active' : '' }}" />
    @endcan

    @can('kabupaten-list')
        <x-nav-link text="Kabupaten" icon="hospital" url="{{ route('admin.kabupaten') }}"
            active="{{ request()->routeIs('admin.kabupaten') ? ' active' : '' }}" />
    @endcan

    @can('kecamatan-list')
        <x-nav-link text="Kecamatan" icon="road" url="{{ route('admin.kecamatan') }}"
            active="{{ request()->routeIs('admin.kecamatan') ? ' active' : '' }}" />
    @endcan

    @can('kelurahan-list')
        <x-nav-link text="Kelurahan" icon="anchor" url="{{ route('admin.kelurahan') }}"
            active="{{ request()->routeIs('admin.kelurahan') ? ' active' : '' }}" />
    @endcan

    @can('role-list')
        <x-nav-link text="Roles" icon="th-list" url="{{ route('admin.roles') }}"
            active="{{ request()->routeIs('admin.roles') ? ' active' : '' }}" />
    @endcan

    @can('permintaan-wisata-list')
        <x-nav-link text="Verifikasi Wisata" icon="th-list" url="{{ route('admin.permintaan-wisata') }}"
            active="{{ request()->routeIs('admin.permintaan-wisata') ? ' active' : '' }}" />
    @endcan

    {{-- masih butuh perbaikan --}}
    @if(auth()->user()->roles->first()->name == 'Wisatawan')
    <x-nav-link text="Tambahkan Wisata" icon="th-list" url="{{ route('admin.tambahkan-wisata') }}"
        active="{{ request()->routeIs('admin.tambahkan-wisata') ? ' active' : '' }}" />
    @endif

    <hr class="sidebar-divider mb-0">

    @can('setting-list')
        <x-nav-link text="Settings" icon="cogs" url="{{ route('admin.settings') }}"
            active="{{ request()->routeIs('admin.settings') ? ' active' : '' }}" />
    @endcan
</ul>
