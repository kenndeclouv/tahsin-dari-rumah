<!-- Sidebar -->
<div id="hs-sidebar-content-push-to-mini-sidebar"
    class="peer hs-overlay [--auto-close:lg] hs-overlay-minified:w-20 lg:block lg:translate-x-0 lg:inset-e-auto lg:bottom-0 w-64
hs-overlay-open:translate-x-0
-translate-x-full transition-all duration-300 transform
h-full
hidden
overflow-x-hidden
fixed top-0 inset-s-0 bottom-0 z-[60]
bg-slate-900 border-e border-slate-800"
    role="dialog" tabindex="-1" aria-label="Sidebar">
    <div class="relative flex flex-col h-full max-h-full">
        <!-- Header -->
        <header class="py-4 px-2 flex justify-between items-center gap-x-2">
            <a class="flex-none font-bold text-md text-white focus:outline-none focus:opacity-80 hs-overlay-minified:hidden flex items-center gap-2 px-2"
                href="/" aria-label="Brand">
                <span class="text-primary-100">{{ config('app.name') }}</span>
            </a>

            <div class="lg:hidden">
                <!-- Close Button -->
                <button type="button"
                    class="flex justify-center items-center gap-x-3 size-6 bg-slate-800 border border-slate-700 text-sm text-slate-400 hover:bg-slate-700 hover:text-white rounded-full disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-slate-700"
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
                    class="flex justify-center items-center flex-none gap-x-3 size-9 text-sm text-slate-400 hover:bg-slate-800 hover:text-white rounded-full disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-slate-800 focus:text-white"
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
            class="h-full overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-none [&::-webkit-scrollbar-track]:bg-slate-800 [&::-webkit-scrollbar-thumb]:bg-slate-600">
            <div class="hs-accordion-group pb-0 px-2 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
                <ul class="space-y-1 hs-accordion-group" data-hs-accordion-always-open>
                    <!-- MAIN -->
                    <li class="px-2 pt-2 pb-1 hs-overlay-minified:hidden">
                        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Main</span>
                    </li>

                    <li>
                        <a class="min-h-[36px] flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-300 rounded-lg hover:bg-slate-800 hover:text-white {{ request()->routeIs('dashboard') ? 'bg-primary-600 text-white font-medium' : '' }}"
                            href="{{ route('dashboard') }}">
                            <i class="fa-regular fa-grid-2 hs-overlay-minified:mx-auto"></i>
                            <span class="hs-overlay-minified:hidden">Dashboard</span>
                        </a>
                    </li>

                    @canany(['santris:view', 'users:view', 'paket_belajars:view', 'kelas:view', 'mukafaahs:view'])
                        <li class="px-2 pt-4 pb-1 hs-overlay-minified:hidden">
                            <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Akademik</span>
                        </li>
                    @endcanany

                    @can('santris:view')
                        <li>
                            <a class="min-h-[36px] flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-300 rounded-lg hover:bg-slate-800 hover:text-white {{ request()->routeIs('santris.*') ? 'bg-primary-600 text-white font-medium' : '' }}"
                                href="{{ route('santris.index') }}">
                                <i class="fa-regular fa-users hs-overlay-minified:mx-auto"></i>
                                <span class="hs-overlay-minified:hidden">Data Santri</span>
                            </a>
                        </li>
                    @endcan

                    @can('users:view')
                        <li>
                            <a class="min-h-[36px] flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-300 rounded-lg hover:bg-slate-800 hover:text-white {{ request()->routeIs('pengajars.*') ? 'bg-primary-600 text-white font-medium' : '' }}"
                                href="{{ route('pengajars.index') }}">
                                <i class="fa-regular fa-chalkboard-user hs-overlay-minified:mx-auto"></i>
                                <span class="hs-overlay-minified:hidden">Data Pengajar</span>
                            </a>
                        </li>
                    @endcan

                    @can('kelas:view')
                        <li>
                            <a class="min-h-[36px] flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-300 rounded-lg hover:bg-slate-800 hover:text-white {{ request()->routeIs('kelas.*') ? 'bg-primary-600 text-white font-medium' : '' }}"
                                href="{{ route('kelas.index') }}">
                                <i class="fa-regular fa-book-open hs-overlay-minified:mx-auto"></i>
                                <span class="hs-overlay-minified:hidden">Data Kelas</span>
                            </a>
                        </li>
                    @endcan

                    @can('mukafaahs:view')
                        <li>
                            <a class="min-h-[36px] flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-300 rounded-lg hover:bg-slate-800 hover:text-white {{ request()->routeIs('rekap.pengajar') ? 'bg-primary-600 text-white font-medium' : '' }}"
                                href="{{ route('rekap.pengajar') }}">
                                <i class="fa-regular fa-money-check-dollar hs-overlay-minified:mx-auto"></i>
                                <span class="hs-overlay-minified:hidden">Rekap Pengajar</span>
                            </a>
                        </li>
                    @endcan

                    @can('presensis:view')
                        <li>
                            <a class="min-h-[36px] flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-300 rounded-lg hover:bg-slate-800 hover:text-white {{ request()->routeIs('rekap.santri') ? 'bg-primary-600 text-white font-medium' : '' }}"
                                href="{{ route('rekap.santri') }}">
                                <i class="fa-regular fa-file-invoice hs-overlay-minified:mx-auto"></i>
                                <span class="hs-overlay-minified:hidden">Rekap Santri</span>
                            </a>
                        </li>
                    @endcan

                    @can('paket_belajars:view')
                        <li>
                            <a class="min-h-[36px] flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-300 rounded-lg hover:bg-slate-800 hover:text-white {{ request()->routeIs('paket_belajars.*') ? 'bg-primary-600 text-white font-medium' : '' }}"
                                href="{{ route('paket_belajars.index') }}">
                                <i class="fa-regular fa-box-archive hs-overlay-minified:mx-auto"></i>
                                <span class="hs-overlay-minified:hidden">Paket Belajar</span>
                            </a>
                        </li>
                    @endcan

                    @canany(['santri_fields:view', 'pengajar_fields:view'])
                        @php
                            $isAdvancedActive =
                                request()->routeIs('santri_fields.*') ||
                                request()->routeIs('pengajar_fields.*');
                        @endphp
                        <li class="hs-accordion" id="advanced-accordion">
                            <button type="button"
                                class="hs-accordion-toggle min-h-[36px] w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-300 rounded-lg hover:bg-slate-800 hover:text-white focus:outline-none focus:bg-slate-800 {{ $isAdvancedActive ? 'bg-slate-800' : '' }}"
                                aria-expanded="{{ $isAdvancedActive ? 'true' : 'false' }}"
                                aria-controls="advanced-accordion-collapse">
                                <i class="fa-regular fa-sliders hs-overlay-minified:mx-auto"></i>
                                <span class="hs-overlay-minified:hidden">Advanced</span>

                                <svg class="hs-accordion-active:block ms-auto hidden size-4"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="m18 15-6-6-6 6" />
                                </svg>
                                <svg class="hs-accordion-active:hidden ms-auto block size-4"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>

                            <div id="advanced-accordion-collapse"
                                class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 {{ $isAdvancedActive ? 'block' : 'hidden' }}"
                                role="region" aria-labelledby="advanced-accordion">
                                <ul class="pt-2 ps-7 space-y-1">
                                    @can('santri_fields:view')
                                        <li>
                                            <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-300 rounded-lg hover:bg-slate-800 hover:text-white {{ request()->routeIs('santri_fields.*') ? 'bg-primary-600 text-white font-medium' : '' }}"
                                                href="{{ route('santri_fields.index') }}">
                                                Custom Field Santri
                                            </a>
                                        </li>
                                    @endcan

                                    @can('pengajar_fields:view')
                                        <li>
                                            <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-300 rounded-lg hover:bg-slate-800 hover:text-white {{ request()->routeIs('pengajar_fields.*') ? 'bg-primary-600 text-white font-medium' : '' }}"
                                                href="{{ route('pengajar_fields.index') }}">
                                                Custom Field Pengajar
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcanany

                    @canany(['roles:view', 'users:view'])
                        <li class="px-2 pt-4 pb-1 hs-overlay-minified:hidden">
                            <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Access
                                Control</span>
                        </li>
                    @endcanany

                    @can('roles:view')
                        <li>
                            <a class="min-h-[36px] flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-300 rounded-lg hover:bg-slate-800 hover:text-white {{ request()->routeIs('roles.*') ? 'bg-primary-600 text-white font-medium' : '' }}"
                                href="{{ route('roles.index') }}">
                                <i class="fa-regular fa-shield-halved hs-overlay-minified:mx-auto"></i>
                                <span class="hs-overlay-minified:hidden">Roles</span>
                            </a>
                        </li>
                    @endcan

                    @can('users:view')
                        <li>
                            <a class="min-h-[36px] flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-300 rounded-lg hover:bg-slate-800 hover:text-white {{ request()->routeIs('users.*') ? 'bg-primary-600 text-white font-medium' : '' }}"
                                href="{{ route('users.index') }}">
                                <i class="fa-regular fa-people-group hs-overlay-minified:mx-auto"></i>
                                <span class="hs-overlay-minified:hidden">Users</span>
                            </a>
                        </li>
                    @endcan



                </ul>
            </div>
        </nav>
        <!-- End Body -->
    </div>
</div>
<!-- End Sidebar -->
