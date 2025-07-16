@push('sidebar-menu')
    <li class="menu-item {{ request()->routeIs('admin.user.*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-users"></i>
            <div data-i18n="User">User</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('admin.user.index') ? 'active' : '' }}">
                <a href="{{ route('admin.user.index') }}" class="menu-link">
                    <div data-i18n="Index">Index</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.user.create') ? 'active' : '' }}">
                <a href="{{ route('admin.user.create') }}" class="menu-link">
                    <div data-i18n="Create">Create</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.user.deleted') ? 'active' : '' }}">
                <a href="{{ route('admin.user.deleted') }}" class="menu-link">
                    <div data-i18n="Restore">Restore</div>
                </a>
            </li>
        </ul>
    </li>
@endpush
