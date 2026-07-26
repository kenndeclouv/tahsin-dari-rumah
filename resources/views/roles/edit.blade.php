<x-layouts.app title="Edit Role">

    <x-slot:actions>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">
            <i class="ti ti-arrow-left me-1"></i> Kembali
        </a>
    </x-slot:actions>

    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-7">
            <div class="card">
                <div class="card-header border-bottom border-dashed">
                    <h4 class="header-title">Edit Role</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('roles.update', $role) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">
                                Nama Role <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name', $role->name) }}"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Contoh: editor, manager, staff" autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy me-1"></i> Update Role
                            </button>
                            <a href="{{ route('roles.index') }}" class="btn btn-light">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
