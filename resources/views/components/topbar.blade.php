<!-- ========== HEADER ========== -->
<header class="sticky top-0 inset-x-0 flex flex-wrap sm:justify-start sm:flex-nowrap z-[48] w-full bg-white border-b border-gray-200 text-sm py-2.5 sm:py-4 lg:ps-64 hs-overlay-minified:lg:ps-20 transition-all duration-300">
    <nav class="flex basis-full items-center w-full mx-auto px-4 sm:px-6 md:px-8" aria-label="Global">
        
        {{-- <div class="me-5 lg:me-0 lg:hidden">
            <!-- Mobile Logo -->
            <a class="flex-none text-xl font-semibold text-gray-900" href="/">📖</a>
        </div> --}}

        <div class="w-full flex items-center justify-between sm:gap-x-3 sm:order-3">
            
            <!-- Mobile Sidebar Toggle -->
            <div class="lg:hidden">
                <button type="button" class="w-[2.375rem] h-[2.375rem] inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#hs-sidebar-content-push-to-mini-sidebar" aria-controls="hs-sidebar-content-push-to-mini-sidebar" aria-label="Toggle navigation">
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" x2="21" y1="6" y2="6"/><line x1="3" x2="21" y1="12" y2="12"/><line x1="3" x2="21" y1="18" y2="18"/></svg>
                </button>
            </div>

            <!-- Spacer for Desktop -->
            <div class="hidden lg:block w-full"></div>

            <div class="flex flex-row items-center justify-end gap-2">

                <!-- Theme Toggle Placeholder (If needed) -->
                <button type="button" class="w-[2.375rem] h-[2.375rem] inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100">
                    <i class="fa-solid fa-moon text-lg"></i>
                </button>

                <!-- User Dropdown -->
                <div class="hs-dropdown [--placement:bottom-right] relative inline-flex">
                    <button id="hs-dropdown-with-header" type="button" class="w-[2.375rem] h-[2.375rem] inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none">
                        <img class="inline-block size-[36px] rounded-full object-cover ring-2 ring-gray-100" src="{{ auth()->user()->photo_url }}" alt="Avatar">
                    </button>

                    <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg p-2 mt-2 border border-gray-200" aria-labelledby="hs-dropdown-with-header">
                        <div class="py-3 px-5 -m-2 bg-gray-50 rounded-t-lg border-b border-gray-200">
                            <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                        </div>
                        <div class="mt-2 py-2 first:pt-0 last:pb-0">
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-primary-500" href="{{ route('profile.show') }}">
                                <i class="fa-solid fa-user-shield text-lg"></i>
                                Pengaturan Profil
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-red-600 hover:bg-red-50 focus:ring-2 focus:ring-red-500">
                                    <i class="fa-solid fa-right-from-bracket text-lg"></i>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
<!-- ========== END HEADER ========== -->
