@push('sidebar-menu')
    <li class="menu-item {{ request()->routeIs('admin.album.*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-album"></i>
            <div data-i18n="Album">Album</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('admin.album.index') ? 'active' : '' }}">
                <a href="{{ route('admin.album.index') }}" class="menu-link">
                    <div data-i18n="Index">Index</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.album.create') ? 'active' : '' }}">
                <a href="{{ route('admin.album.create') }}" class="menu-link">
                    <div data-i18n="Create">Create</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.album.deleted') ? 'active' : '' }}">
                <a href="{{ route('admin.album.deleted') }}" class="menu-link">
                    <div data-i18n="Restore">Restore</div>
                </a>
            </li>
        </ul>
    </li>
@endpush
