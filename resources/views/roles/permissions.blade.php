<x-layouts.app title="Atur Permissions — {{ $role->name }}">
    <div class="max-w-6xl">
        <form action="{{ route('roles.permissions.update', $role) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="bg-blue-50 border border-blue-200 text-blue-800 rounded-lg p-4 mb-6 flex gap-3" role="alert">
                <svg class="shrink-0 size-5 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                <div>
                    Anda sedang mengatur permissions untuk role <span class="font-bold">{{ $role->name }}</span>.
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 lg:gap-6 mb-8">
                @foreach ($allPermissions as $module => $permissions)
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm flex flex-col">
                        <div class="px-5 py-3 border-b border-gray-200 flex justify-between items-center bg-gray-50 rounded-t-xl">
                            <h3 class="text-sm font-semibold text-gray-800 uppercase flex items-center gap-x-2">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 16v.01"/><path d="M16 12v.01"/><path d="M8 12v.01"/><path d="M12 8v.01"/><rect width="18" height="18" x="3" y="3" rx="2"/></svg>
                                {{ $module }}
                            </h3>
                            <div class="flex items-center">
                                <label for="toggle-{{ $module }}" class="text-xs text-gray-500 me-2 cursor-pointer">All</label>
                                <input type="checkbox" id="toggle-{{ $module }}" data-module="{{ $module }}" class="module-toggle relative w-11 h-6 p-px bg-gray-100 border-transparent text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-emerald-500 disabled:opacity-50 disabled:pointer-events-none checked:bg-none checked:text-emerald-600 checked:border-emerald-600 focus:checked:border-emerald-600 before:inline-block before:size-5 before:bg-white checked:before:bg-emerald-200 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200" {{ $permissions->every(fn($p) => in_array($p->name, $rolePermissions)) ? 'checked' : '' }}>
                            </div>
                        </div>
                        <div class="p-5 flex-1">
                            <div class="space-y-3">
                                @foreach ($permissions as $permission)
                                    @php
                                        $action = explode(':', $permission->name)[1] ?? $permission->name;
                                    @endphp
                                    <label for="perm-{{ $permission->id }}" class="flex items-center gap-x-2 text-sm text-gray-700 cursor-pointer">
                                        <input type="checkbox" name="permissions[]" id="perm-{{ $permission->id }}" value="{{ $permission->name }}" class="perm-check perm-{{ $module }} shrink-0 mt-0.5 border-gray-200 rounded text-emerald-600 focus:ring-emerald-500 disabled:opacity-50 disabled:pointer-events-none" {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                                        {{ $action }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-start gap-x-3">
                <a href="{{ route('roles.index') }}" class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                    Kembali
                </a>
                <button type="submit" class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-emerald-600 text-white hover:bg-emerald-700 disabled:opacity-50 disabled:pointer-events-none">
                    Simpan Permissions
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        // Toggle all checkboxes in a module
        document.querySelectorAll('.module-toggle').forEach(function(toggle) {
            toggle.addEventListener('change', function() {
                const module = this.dataset.module;
                document.querySelectorAll('.perm-' + module).forEach(function(cb) {
                    cb.checked = toggle.checked;
                });
            });
        });

        // Update toggle state when individual permission is changed
        document.querySelectorAll('.perm-check').forEach(function(cb) {
            cb.addEventListener('change', function() {
                const classList = Array.from(this.classList);
                const moduleClass = classList.find(c => c.startsWith('perm-') && c !== 'perm-check');
                if (!moduleClass) return;
                const module = moduleClass.replace('perm-', '');
                const all = document.querySelectorAll('.perm-' + module);
                const checked = document.querySelectorAll('.perm-' + module + ':checked');
                document.getElementById('toggle-' + module).checked = (all.length === checked.length);
            });
        });
    </script>
    @endpush
</x-layouts.app>
