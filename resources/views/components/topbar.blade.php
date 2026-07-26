<!-- Topbar Start -->
<header class="app-topbar">
    <div class="page-container topbar-menu">
        <div class="d-flex align-items-center gap-2">

            <!-- Brand Logo -->
            {{-- <x-logo></x-logo> --}}

            <!-- Sidebar Menu Toggle Button -->
            <button class="sidenav-toggle-button btn btn-secondary btn-icon">
                <i class="ti ti-menu-deep fs-24"></i>
            </button>
        </div>

        <div class="d-flex align-items-center gap-2">
            <!-- Button Trigger Customizer Offcanvas -->
            <div class="topbar-item d-none d-sm-flex">
                <button class="topbar-link btn btn-outline-primary btn-icon" data-bs-toggle="offcanvas"
                    data-bs-target="#theme-settings-offcanvas" type="button">
                    <i class="ti ti-settings fs-22"></i>
                </button>
            </div>

            <!-- Light/Dark Mode Button -->
            <div class="topbar-item d-none d-sm-flex">
                <button class="topbar-link btn btn-outline-primary btn-icon" id="light-dark-mode" type="button">
                    <i class="ti ti-moon fs-22"></i>
                </button>
            </div>

            <!-- User Dropdown -->
            <div class="topbar-item">
                <div class="dropdown">
                    <a class="topbar-link btn btn-outline-primary dropdown-toggle drop-arrow-none"
                        data-bs-toggle="dropdown" data-bs-offset="0,22" type="button" aria-haspopup="false"
                        aria-expanded="false">
                        <img src="{{ auth()->user()->photo_url }}" width="28" height="28"
                            class="rounded-circle me-lg-2 d-flex" alt="avatar" style="object-fit: cover;">
                        <span class="d-lg-flex flex-column gap-1 d-none">
                            {{ auth()->user()->name ?? 'Guest' }}
                        </span>
                        <i class="ti ti-chevron-down d-none d-lg-block align-middle ms-2"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">{{ auth()->user()->name }}</h6>
                            <p class="text-muted fs-11 mb-0">{{ auth()->user()->email }}</p>
                        </div>

                        <!-- item-->
                        <a href="{{ route('profile.show') }}" class="dropdown-item">
                            <i class="ti ti-user-hexagon me-1 fs-17 align-middle"></i>
                            <span class="align-middle">Pengaturan Profil</span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <!-- item-->
                        <a class="dropdown-item fw-semibold text-danger" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="ti ti-logout me-1 fs-17 align-middle"></i>
                            <span class="align-middle">Sign Out</span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Topbar End -->
