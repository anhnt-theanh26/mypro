@push('sidebar-menu')
    <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active open' : '' }}" style="">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-smart-home"></i>
            <div data-i18n="Dashboards">Dashboards</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="menu-link">
                    <div data-i18n="eCommerce">eCommerce</div>
                </a>
            </li>
        </ul>
    </li>
@endpush
