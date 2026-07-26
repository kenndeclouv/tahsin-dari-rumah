<x-layouts.app title="Tambah User">

    <x-slot:actions>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">
            <i class="ti ti-arrow-left me-1"></i> Kembali
        </a>
    </x-slot:actions>

    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-8">
            <div class="card">
                <div class="card-header border-bottom border-dashed">
                    <h4 class="header-title">Buat User Baru</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nama <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Nama lengkap"
                                autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email <span
                                    class="text-danger">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="email@example.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password <span
                                    class="text-danger">*</span></label>
                            <input type="password" id="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Minimal 8 karakter">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password <span
                                    class="text-danger">*</span></label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control" placeholder="Ulangi password">
                        </div>

                        {{-- Roles --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Roles</label>
                            <div class="row row-cols-2 g-2">
                                @foreach ($roles as $role)
                                    <div class="col">
                                        <div
                                            class="form-check card p-2 mb-0 @if (in_array($role->name, old('roles', []))) border-primary @endif">
                                            <input class="form-check-input" type="checkbox" name="roles[]"
                                                id="role-{{ $role->id }}" value="{{ $role->name }}"
                                                {{ in_array($role->name, old('roles', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label w-100 ps-1 cursor-pointer"
                                                for="role-{{ $role->id }}">
                                                <span class="fw-semibold d-block">{{ $role->name }}</span>
                                                <span class="text-muted fs-11">{{ $role->permissions->count() }}
                                                    permission</span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @if ($roles->isEmpty())
                                <p class="text-muted fs-12 mt-2">Belum ada role. <a
                                        href="{{ route('roles.create') }}">Buat role</a> terlebih dahulu.</p>
                            @endif
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy me-1"></i> Simpan User
                            </button>
                            <a href="{{ route('users.index') }}" class="btn btn-light">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
