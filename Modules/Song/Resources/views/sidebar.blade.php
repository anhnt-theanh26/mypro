@push('sidebar-menu')
    <li class="menu-item {{ request()->routeIs('admin.song.*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-music"></i>
            <div data-i18n="Song">Song</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('admin.song.index') ? 'active' : '' }}">
                <a href="{{ route('admin.song.index') }}" class="menu-link">
                    <div data-i18n="Index">Index</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.song.create') ? 'active' : '' }}">
                <a href="{{ route('admin.song.create') }}" class="menu-link">
                    <div data-i18n="Create">Create</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.song.deleted') ? 'active' : '' }}">
                <a href="{{ route('admin.song.deleted') }}" class="menu-link">
                    <div data-i18n="Restore">Restore</div>
                </a>
            </li>
        </ul>
    </li>
@endpush
