<x-layouts.app title="Pengaturan Profil">

    <div class="row justify-content-center g-4">

        {{-- ─── LEFT: Avatar card ───────────────────────────────────────────── --}}
        <div class="col-lg-3 col-md-4">

            {{-- Photo card --}}
            <div class="card text-center mb-3">
                <div class="card-body py-4">

                    {{-- Avatar --}}
                    <div class="position-relative d-inline-block mb-3">
                        <img id="avatar-preview" src="{{ auth()->user()->photo_url }}" alt="avatar"
                            class="rounded-circle border border-3"
                            style="width: 100px; height: 100px; object-fit: cover; border-color: var(--bs-primary) !important;">

                        {{-- Camera badge --}}
                        <label for="photo-input"
                            class="position-absolute bottom-0 end-0 btn btn-primary btn-icon rounded-circle"
                            style="width: 30px; height: 30px; padding: 0; border: 2px solid var(--bs-body-bg); cursor: pointer;"
                            title="Ganti foto">
                            <i class="ti ti-camera fs-14"></i>
                        </label>
                    </div>

                    <h5 class="fw-bold mb-0">{{ auth()->user()->name }}</h5>
                    <p class="text-muted fs-12 mb-3">{{ auth()->user()->email }}</p>

                    @foreach (auth()->user()->roles as $role)
                        <span class="badge bg-primary-subtle text-primary me-1">{{ $role->name }}</span>
                    @endforeach

                    {{-- Hidden upload form --}}
                    <form id="photo-form" action="{{ route('profile.photo') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="file" id="photo-input" name="photo" accept="image/*" class="d-none"
                            onchange="submitPhotoForm(this)">
                    </form>

                    {{-- Remove photo --}}
                    @if (auth()->user()->photo)
                        <form action="{{ route('profile.photo.remove') }}" method="POST" class="mt-2">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="ti ti-trash me-1"></i> Hapus Foto
                            </button>
                        </form>
                    @endif

                </div>
            </div>

            {{-- Quick info --}}
            <div class="card">
                <div class="card-body p-3">
                    <p class="text-muted fs-11 text-uppercase fw-semibold mb-2">Informasi Akun</p>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="ti ti-calendar-event text-muted fs-16"></i>
                        <div>
                            <p class="mb-0 fs-12 text-muted">Bergabung</p>
                            <p class="mb-0 fs-13 fw-semibold">
                                {{ auth()->user()->created_at->translatedFormat('d F Y') }}</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="ti ti-shield-check text-muted fs-16"></i>
                        <div>
                            <p class="mb-0 fs-12 text-muted">Role</p>
                            <p class="mb-0 fs-13 fw-semibold">
                                {{ auth()->user()->roles->pluck('name')->join(', ') ?: 'Tidak ada' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ─── RIGHT: Settings forms ───────────────────────────────────────── --}}
        <div class="col-lg-7 col-md-8">

            {{-- ── General Info ─────────────────────────────────────────────── --}}
            <div class="card mb-4">
                <div class="card-header border-bottom border-dashed d-flex align-items-center gap-2">
                    <i class="ti ti-user-edit fs-18 text-primary"></i>
                    <h5 class="header-title mb-0">Informasi Umum</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.info') }}" method="POST">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Nama lengkap"
                                    autofocus>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="alamat@email.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- ── Change Password ──────────────────────────────────────────── --}}
            <div class="card mb-4">
                <div class="card-header border-bottom border-dashed d-flex align-items-center gap-2">
                    <i class="ti ti-lock-password fs-18 text-warning"></i>
                    <h5 class="header-title mb-0">Ubah Password</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.password') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password Saat Ini <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" name="current_password" id="cur-pass"
                                    class="form-control @error('current_password') is-invalid @enderror"
                                    placeholder="Password lama">
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="togglePass('cur-pass', 'eye-cur')">
                                    <i id="eye-cur" class="ti ti-eye"></i>
                                </button>
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password Baru <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" name="password" id="new-pass"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Min. 8 karakter, huruf & angka">
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="togglePass('new-pass', 'eye-new')">
                                    <i id="eye-new" class="ti ti-eye"></i>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- Password strength indicator --}}
                            <div class="mt-2" id="strength-bar-wrap" style="display:none">
                                <div class="progress" style="height: 5px;">
                                    <div id="strength-bar" class="progress-bar" style="width:0%;transition:.3s">
                                    </div>
                                </div>
                                <small id="strength-label" class="text-muted fs-11"></small>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Konfirmasi Password Baru <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" name="password_confirmation" id="conf-pass"
                                    class="form-control" placeholder="Ulangi password baru">
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="togglePass('conf-pass', 'eye-conf')">
                                    <i id="eye-conf" class="ti ti-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="alert alert-info d-flex align-items-center gap-2 py-2 fs-12 mb-4">
                            <i class="ti ti-info-circle fs-16"></i>
                            Password harus minimal 8 karakter dan mengandung huruf serta angka.
                        </div>

                        <button type="submit" class="btn btn-warning">
                            <i class="ti ti-lock me-1"></i> Perbarui Password
                        </button>
                    </form>
                </div>
            </div>

            {{-- ── Danger Zone ──────────────────────────────────────────────── --}}
            <div class="card border-danger" style="border-width: 2px !important;">
                <div class="card-header border-bottom border-danger d-flex align-items-center gap-2"
                    style="background: rgba(var(--bs-danger-rgb), .05);">
                    <i class="ti ti-alert-triangle fs-18 text-danger"></i>
                    <h5 class="header-title mb-0 text-danger">Danger Zone</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                        <div>
                            <h6 class="fw-semibold mb-1">Logout dari semua perangkat</h6>
                            <p class="text-muted fs-12 mb-0">Sesi aktif di perangkat lain akan diakhiri.</p>
                        </div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="ti ti-logout me-1"></i> Sign Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        // ── Toggle password visibility ────────────────────────────────────────
        function togglePass(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'ti ti-eye-off';
            } else {
                input.type = 'password';
                icon.className = 'ti ti-eye';
            }
        }

        // ── Avatar instant-preview + auto-submit ─────────────────────────────
        function submitPhotoForm(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    document.getElementById('avatar-preview').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
                document.getElementById('photo-form').submit();
            }
        }

        // ── Password strength checker ─────────────────────────────────────────
        document.getElementById('new-pass').addEventListener('input', function() {
            const val = this.value;
            const wrap = document.getElementById('strength-bar-wrap');
            const bar = document.getElementById('strength-bar');
            const lbl = document.getElementById('strength-label');
            if (!val) {
                wrap.style.display = 'none';
                return;
            }
            wrap.style.display = 'block';
            let score = 0;
            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;
            const levels = [{
                    pct: 25,
                    cls: 'bg-danger',
                    txt: 'Sangat Lemah'
                },
                {
                    pct: 50,
                    cls: 'bg-warning',
                    txt: 'Lemah'
                },
                {
                    pct: 75,
                    cls: 'bg-info',
                    txt: 'Sedang'
                },
                {
                    pct: 100,
                    cls: 'bg-success',
                    txt: 'Kuat'
                },
            ];
            const l = levels[score - 1] || levels[0];
            bar.style.width = l.pct + '%';
            bar.className = 'progress-bar ' + l.cls;
            lbl.textContent = l.txt;
        });
    </script>

</x-layouts.app>
