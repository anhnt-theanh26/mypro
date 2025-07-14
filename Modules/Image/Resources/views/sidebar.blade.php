@push('sidebar-menu')
    <li class="menu-item {{ request()->routeIs('admin.image.*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-photo"></i>
            <div data-i18n="Images">Images</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('admin.image.index') ? 'active' : '' }}">
                <a href="{{ route('admin.image.index') }}" class="menu-link">
                    <div data-i18n="Index">Index</div>
                </a>
            </li>
        </ul>
    </li>
@endpush
