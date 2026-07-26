<x-layouts.app title="Atur Permissions — {{ $role->name }}">

    <x-slot:actions>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">
            <i class="ti ti-arrow-left me-1"></i> Kembali ke Roles
        </a>
    </x-slot:actions>

    <form action="{{ route('roles.permissions.update', $role) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-12 mb-3">
                <div class="alert alert-info d-flex align-items-center gap-2 border-0">
                    <i class="ti ti-info-circle fs-20"></i>
                    <span>Anda sedang mengatur permissions untuk role <strong>{{ $role->name }}</strong>.</span>
                </div>
            </div>

            {{-- Permission Groups --}}
            @foreach ($allPermissions as $module => $permissions)
                <div class="col-xl-4 col-md-6">
                    <div class="card mb-3">
                        <div
                            class="card-header d-flex justify-content-between align-items-center border-bottom border-dashed py-2">
                            <h5 class="header-title text-uppercase mb-0 fs-13">
                                <i class="ti ti-layers-intersect me-1"></i>
                                {{ $module }}
                            </h5>
                            {{-- Select All toggle --}}
                            <div class="form-check form-switch mb-0">
                                <input class="form-check-input module-toggle" type="checkbox"
                                    data-module="{{ $module }}" id="toggle-{{ $module }}"
                                    {{ $permissions->every(fn($p) => in_array($p->name, $rolePermissions)) ? 'checked' : '' }}>
                                <label class="form-check-label text-muted fs-11"
                                    for="toggle-{{ $module }}">All</label>
                            </div>
                        </div>
                        <div class="card-body">
                            @foreach ($permissions as $permission)
                                @php
                                    $action = explode(':', $permission->name)[1] ?? $permission->name;
                                @endphp
                                <div class="form-check mb-2">
                                    <input class="form-check-input perm-check perm-{{ $module }}" type="checkbox"
                                        name="permissions[]" id="perm-{{ $permission->id }}"
                                        value="{{ $permission->name }}"
                                        {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="perm-{{ $permission->id }}">
                                        {{ $action }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- Submit --}}
            <div class="col-12">
                <button type="submit" class="btn btn-primary">
                    <i class="ti ti-device-floppy me-1"></i> Simpan Permissions
                </button>
            </div>
        </div>
    </form>

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

</x-layouts.app>
