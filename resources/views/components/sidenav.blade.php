<!-- Sidenav Menu Start -->
<div class="sidenav-menu pt-3">
    <!-- LOGO -->
    <a href="/" class="logo text-decoration-none ms-3 mb-2 d-inline-block">
        <span class="logo-lg text-dark">
            <h4 class="fw-bold mb-0" style="white-space: nowrap;">📖 {{ config('app.name') }}</h4>
        </span>
        <span class="logo-sm text-dark ms-1">
            <h3 class="fw-bold mb-0">📖</h3>
        </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <button class="button-sm-hover">
        <i class="ti ti-circle align-middle"></i>
    </button>

    <!-- Full Sidebar Menu Close Button -->
    <button class="button-close-fullsidebar">
        <i class="ti ti-x align-middle"></i>
    </button>

    <div data-simplebar>

        <!--- Sidenav Menu -->
        <ul class="side-nav">

            <li class="side-nav-title">Main</li>

            <li class="side-nav-item">
                <a href="{{ route('dashboard') }}"
                    class="side-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
                    <span class="menu-text"> Dashboard </span>
                </a>
            </li>

            @canany(['santris:view', 'paket_belajars:view'])
                <li class="side-nav-title mt-2">Akademik</li>
            @endcanany

            @can('santris:view')
                <li class="side-nav-item">
                    <a href="{{ route('santris.index') }}"
                        class="side-nav-link {{ request()->routeIs('santris.*') ? 'active' : '' }}">
                        <span class="menu-icon"><i class="ti ti-users"></i></span>
                        <span class="menu-text"> Data Santri </span>
                    </a>
                </li>
                
                <li class="side-nav-item">
                    <a href="{{ route('pengajars.index') }}"
                        class="side-nav-link {{ request()->routeIs('pengajars.*') ? 'active' : '' }}">
                        <span class="menu-icon"><i class="ti ti-user-check"></i></span>
                        <span class="menu-text"> Data Pengajar </span>
                    </a>
                </li>

                <li class="side-nav-item">
                    <a href="{{ route('fees.index') }}"
                        class="side-nav-link {{ request()->routeIs('fees.*') ? 'active' : '' }}">
                        <span class="menu-icon"><i class="ti ti-cash"></i></span>
                        <span class="menu-text"> Master Fee </span>
                    </a>
                </li>

            @endcan

            @can('paket_belajars:view')
                <li class="side-nav-item">
                    <a href="{{ route('paket_belajars.index') }}"
                        class="side-nav-link {{ request()->routeIs('paket_belajars.*') ? 'active' : '' }}">
                        <span class="menu-icon"><i class="ti ti-book-2"></i></span>
                        <span class="menu-text"> Paket Belajar </span>
                    </a>
                </li>
                
                <li class="side-nav-item">
                    <a href="{{ route('mukafaah.index') }}"
                        class="side-nav-link {{ request()->routeIs('mukafaah.*') ? 'active' : '' }}">
                        <span class="menu-icon"><i class="ti ti-coin"></i></span>
                        <span class="menu-text"> Rekap Mukafaah </span>
                    </a>
                </li>
            @endcan

            @canany(['roles:view', 'users:view'])
                <li class="side-nav-title mt-2">Access Control</li>
            @endcanany

            @can('roles:view')
                <li class="side-nav-item">
                    <a href="{{ route('roles.index') }}"
                        class="side-nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                        <span class="menu-icon"><i class="ti ti-shield-lock-filled"></i></span>
                        <span class="menu-text"> Roles </span>
                    </a>
                </li>
            @endcan

            @can('users:view')
                <li class="side-nav-item">
                    <a href="{{ route('users.index') }}"
                        class="side-nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <span class="menu-icon"><i class="ti ti-users-group"></i></span>
                        <span class="menu-text"> Users </span>
                    </a>
                </li>
            @endcan

        </ul>

        @canany(['santri_fields:view', 'paket_belajar_fields:view', 'pengajar_fields:view'])
            <ul class="side-nav">
                <li class="side-nav-title mt-2">Advanced</li>
                @can('santri_fields:view')
                <li class="side-nav-item">
                    <a href="{{ route('santri_fields.index') }}"
                        class="side-nav-link {{ request()->routeIs('santri_fields.*') ? 'active' : '' }}">
                        <span class="menu-icon"><i class="ti ti-adjustments-alt"></i></span>
                        <span class="menu-text"> Custom Field Santri </span>
                    </a>
                </li>
                @endcan
                @can('pengajar_fields:view')
                <li class="side-nav-item">
                    <a href="{{ route('pengajar_fields.index') }}"
                        class="side-nav-link {{ request()->routeIs('pengajar_fields.*') ? 'active' : '' }}">
                        <span class="menu-icon"><i class="ti ti-adjustments-alt"></i></span>
                        <span class="menu-text"> Custom Field Pengajar </span>
                    </a>
                </li>
                @endcan
                @can('paket_belajar_fields:view')
                <li class="side-nav-item">
                    <a href="{{ route('paket_belajar_fields.index') }}"
                        class="side-nav-link {{ request()->routeIs('paket_belajar_fields.*') ? 'active' : '' }}">
                        <span class="menu-icon"><i class="ti ti-adjustments-alt"></i></span>
                        <span class="menu-text"> Custom Field Paket </span>
                    </a>
                </li>
                @endcan
            </ul>
        @endcanany

        <div class="clearfix"></div>
    </div>
</div>
<!-- Sidenav Menu End -->
