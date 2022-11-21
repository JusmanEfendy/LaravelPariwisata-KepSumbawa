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

    @can('member-list')
        <x-nav-link text="Admin" icon="male" url="{{ route('admin.member') }}"
            active="{{ request()->routeIs('admin.member') ? ' active' : '' }}" />
    @endcan

    @can('member-list')
        <x-nav-link text="User" icon="users" url="{{ route('admin.member') }}"
            active="{{ request()->routeIs('admin.member') ? ' active' : '' }}" />
    @endcan

    @can('member-list')
        <x-nav-link text="Kategori Wisata" icon="archive" url="{{ route('admin.kategori') }}"
            active="{{ request()->routeIs('admin.kategori') ? ' active' : '' }}" />
    @endcan

    @can('member-list')
        <x-nav-link text="Wisata" icon="compass" url="{{ route('admin.wisata') }}"
            active="{{ request()->routeIs('admin.wisata') ? ' active' : '' }}" />
    @endcan

    @can('member-list')
        <x-nav-link text="Data Kabupaten" icon="hospital" url="{{ route('admin.kabupaten') }}"
            active="{{ request()->routeIs('admin.kabupaten') ? ' active' : '' }}" />
    @endcan

    @can('member-list')
        <x-nav-link text="Data Kecamatan" icon="road" url="{{ route('admin.kecamatan') }}"
            active="{{ request()->routeIs('admin.kecamatan') ? ' active' : '' }}" />
    @endcan

    @can('member-list')
        <x-nav-link text="Data Kelurahan" icon="anchor" url="{{ route('admin.kelurahan') }}"
            active="{{ request()->routeIs('admin.kelurahan') ? ' active' : '' }}" />
    @endcan

    @can('role-list')
        <x-nav-link text="Roles" icon="th-list" url="{{ route('admin.roles') }}"
            active="{{ request()->routeIs('admin.roles') ? ' active' : '' }}" />
    @endcan

    <hr class="sidebar-divider mb-0">

    @can('setting-list')
        <x-nav-link text="Settings" icon="cogs" url="{{ route('admin.settings') }}"
            active="{{ request()->routeIs('admin.settings') ? ' active' : '' }}" />
    @endcan
</ul>
