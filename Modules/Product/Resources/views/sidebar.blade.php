@push('sidebar-menu')
    <li class="menu-item {{ request()->routeIs('admin.product.*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-brand-producthunt"></i>
            <div data-i18n="Product">Product</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('admin.product.index') ? 'active' : '' }}">
                <a href="{{ route('admin.product.index') }}" class="menu-link">
                    <div data-i18n="Index">Index</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.product.create') ? 'active' : '' }}">
                <a href="{{ route('admin.product.create') }}" class="menu-link">
                    <div data-i18n="Create">Create</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.product.deleted') ? 'active' : '' }}">
                <a href="{{ route('admin.product.deleted') }}" class="menu-link">
                    <div data-i18n="Restore">Restore</div>
                </a>
            </li>
        </ul>
    </li>
@endpush
