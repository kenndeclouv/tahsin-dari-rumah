<!-- Sidebar -->
<div id="hs-sidebar-content-push-to-mini-sidebar"
    class="peer hs-overlay [--auto-close:lg] hs-overlay-minified:w-20 lg:block lg:translate-x-0 lg:inset-e-auto lg:bottom-0 w-64
hs-overlay-open:translate-x-0
-translate-x-full transition-all duration-300 transform
h-full
hidden
overflow-x-hidden
fixed top-0 inset-s-0 bottom-0 z-[60]
bg-white border-e border-gray-200"
    role="dialog" tabindex="-1" aria-label="Sidebar">
    <div class="relative flex flex-col h-full max-h-full">
        <!-- Header -->
        <header class="py-4 px-2 flex justify-between items-center gap-x-2">
            <a class="flex-none font-bold text-md text-gray-900 focus:outline-none focus:opacity-80 hs-overlay-minified:hidden flex items-center gap-2 px-2"
                href="/" aria-label="Brand">
                {{-- <svg class="w-8 h-auto text-emerald-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                </svg> --}}
                <span class="text-primary">{{ config('app.name') }}</span>
            </a>

            <div class="lg:hidden">
                <!-- Close Button -->
                <button type="button"
                    class="flex justify-center items-center gap-x-3 size-6 bg-white border border-gray-200 text-sm text-gray-500 hover:bg-gray-100 rounded-full disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-100"
                    data-hs-overlay="#hs-sidebar-content-push-to-mini-sidebar">
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                    <span class="sr-only">Close</span>
                </button>
                <!-- End Close Button -->
            </div>
            <div class="hidden lg:block hs-overlay-minified:mx-auto">
                <!-- Toggle Button -->
                <button type="button"
                    class="flex justify-center items-center flex-none gap-x-3 size-9 text-sm text-gray-500 hover:bg-gray-100 rounded-full disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-100"
                    aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-sidebar-content-push-to-mini-sidebar"
                    aria-label="Minify navigation" data-hs-overlay-minifier="#hs-sidebar-content-push-to-mini-sidebar">
                    <svg class="hidden hs-overlay-minified:block shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="18" x="3" y="3" rx="2" />
                        <path d="M15 3v18" />
                        <path d="m8 9 3 3-3 3" />
                    </svg>
                    <svg class="hs-overlay-minified:hidden shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="18" x="3" y="3" rx="2" />
                        <path d="M15 3v18" />
                        <path d="m10 15-3-3 3-3" />
                    </svg>
                    <span class="sr-only">Navigation Toggle</span>
                </button>
                <!-- End Toggle Button -->
            </div>
        </header>
        <!-- End Header -->

        <!-- Body -->
        <nav
            class="h-full overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-none [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300">
            <div class="pb-0 px-2 w-full flex flex-col flex-wrap">
                <ul class="space-y-1">
                    <!-- MAIN -->
                    <li class="px-2 pt-2 pb-1 hs-overlay-minified:hidden">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Main</span>
                    </li>

                    <li>
                        <a class="min-h-[36px] flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('dashboard') ? 'bg-emerald-50 text-emerald-700 font-medium' : '' }}"
                            href="{{ route('dashboard') }}">
                            <i class="ti ti-dashboard text-lg hs-overlay-minified:mx-auto"></i>
                            <span class="hs-overlay-minified:hidden">Dashboard</span>
                        </a>
                    </li>

                    @canany(['santris:view', 'paket_belajars:view'])
                        <li class="px-2 pt-4 pb-1 hs-overlay-minified:hidden">
                            <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Akademik</span>
                        </li>
                    @endcanany

                    @can('santris:view')
                        <li>
                            <a class="min-h-[36px] flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('santris.*') ? 'bg-emerald-50 text-emerald-700 font-medium' : '' }}"
                                href="{{ route('santris.index') }}">
                                <i class="ti ti-users text-lg hs-overlay-minified:mx-auto"></i>
                                <span class="hs-overlay-minified:hidden">Data Santri</span>
                            </a>
                        </li>

                        <li>
                            <a class="min-h-[36px] flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('pengajars.*') ? 'bg-emerald-50 text-emerald-700 font-medium' : '' }}"
                                href="{{ route('pengajars.index') }}">
                                <i class="ti ti-user-check text-lg hs-overlay-minified:mx-auto"></i>
                                <span class="hs-overlay-minified:hidden">Data Pengajar</span>
                            </a>
                        </li>

                        <li>
                            <a class="min-h-[36px] flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('fees.*') ? 'bg-emerald-50 text-emerald-700 font-medium' : '' }}"
                                href="{{ route('fees.index') }}">
                                <i class="ti ti-cash text-lg hs-overlay-minified:mx-auto"></i>
                                <span class="hs-overlay-minified:hidden">Master Fee</span>
                            </a>
                        </li>
                    @endcan

                    @can('paket_belajars:view')
                        <li>
                            <a class="min-h-[36px] flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('paket_belajars.*') ? 'bg-emerald-50 text-emerald-700 font-medium' : '' }}"
                                href="{{ route('paket_belajars.index') }}">
                                <i class="ti ti-book-2 text-lg hs-overlay-minified:mx-auto"></i>
                                <span class="hs-overlay-minified:hidden">Paket Belajar</span>
                            </a>
                        </li>

                        <li>
                            <a class="min-h-[36px] flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('mukafaah.*') ? 'bg-emerald-50 text-emerald-700 font-medium' : '' }}"
                                href="{{ route('mukafaah.index') }}">
                                <i class="ti ti-coin text-lg hs-overlay-minified:mx-auto"></i>
                                <span class="hs-overlay-minified:hidden">Rekap Mukafaah</span>
                            </a>
                        </li>
                    @endcan

                    @canany(['roles:view', 'users:view'])
                        <li class="px-2 pt-4 pb-1 hs-overlay-minified:hidden">
                            <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Access
                                Control</span>
                        </li>
                    @endcanany

                    @can('roles:view')
                        <li>
                            <a class="min-h-[36px] flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('roles.*') ? 'bg-emerald-50 text-emerald-700 font-medium' : '' }}"
                                href="{{ route('roles.index') }}">
                                <i class="ti ti-shield-lock-filled text-lg hs-overlay-minified:mx-auto"></i>
                                <span class="hs-overlay-minified:hidden">Roles</span>
                            </a>
                        </li>
                    @endcan

                    @can('users:view')
                        <li>
                            <a class="min-h-[36px] flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('users.*') ? 'bg-emerald-50 text-emerald-700 font-medium' : '' }}"
                                href="{{ route('users.index') }}">
                                <i class="ti ti-users-group text-lg hs-overlay-minified:mx-auto"></i>
                                <span class="hs-overlay-minified:hidden">Users</span>
                            </a>
                        </li>
                    @endcan

                    @canany(['santri_fields:view', 'paket_belajar_fields:view', 'pengajar_fields:view'])
                        <li class="px-2 pt-4 pb-1 hs-overlay-minified:hidden">
                            <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Advanced</span>
                        </li>

                        @can('santri_fields:view')
                            <li>
                                <a class="min-h-[36px] flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('santri_fields.*') ? 'bg-emerald-50 text-emerald-700 font-medium' : '' }}"
                                    href="{{ route('santri_fields.index') }}">
                                    <i class="ti ti-adjustments-alt text-lg hs-overlay-minified:mx-auto"></i>
                                    <span class="hs-overlay-minified:hidden">Custom Field Santri</span>
                                </a>
                            </li>
                        @endcan

                        @can('pengajar_fields:view')
                            <li>
                                <a class="min-h-[36px] flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('pengajar_fields.*') ? 'bg-emerald-50 text-emerald-700 font-medium' : '' }}"
                                    href="{{ route('pengajar_fields.index') }}">
                                    <i class="ti ti-adjustments-alt text-lg hs-overlay-minified:mx-auto"></i>
                                    <span class="hs-overlay-minified:hidden">Custom Field Pengajar</span>
                                </a>
                            </li>
                        @endcan

                        @can('paket_belajar_fields:view')
                            <li>
                                <a class="min-h-[36px] flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('paket_belajar_fields.*') ? 'bg-emerald-50 text-emerald-700 font-medium' : '' }}"
                                    href="{{ route('paket_belajar_fields.index') }}">
                                    <i class="ti ti-adjustments-alt text-lg hs-overlay-minified:mx-auto"></i>
                                    <span class="hs-overlay-minified:hidden">Custom Field Paket</span>
                                </a>
                            </li>
                        @endcan
                    @endcanany

                </ul>
            </div>
        </nav>
        <!-- End Body -->
    </div>
</div>
<!-- End Sidebar -->
