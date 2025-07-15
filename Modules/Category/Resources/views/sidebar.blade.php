@push('sidebar-menu')
    <li class="menu-item {{ request()->routeIs('admin.category.*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-folders"></i>
            <div data-i18n="Category">Category</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('admin.category.index') ? 'active' : '' }}">
                <a href="{{ route('admin.category.index') }}" class="menu-link">
                    <div data-i18n="Index">Index</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.category.create') ? 'active' : '' }}">
                <a href="{{ route('admin.category.create') }}" class="menu-link">
                    <div data-i18n="Create">Create</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.category.deleted') ? 'active' : '' }}">
                <a href="{{ route('admin.category.deleted') }}" class="menu-link">
                    <div data-i18n="Restore">Restore</div>
                </a>
            </li>
        </ul>
    </li>
@endpush
