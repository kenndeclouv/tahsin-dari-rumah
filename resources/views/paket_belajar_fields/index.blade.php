<x-layouts.app title="Pengaturan Form Santri">
    <div class="card">
        <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
            <h5 class="header-title mb-0">Pengaturan Form Santri (Dynamic Fields)</h5>
            <a href="{{ route('paket_belajar_fields.create') }}" class="btn btn-primary btn-sm">Tambah Field</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Order</th>
                            <th>Label</th>
                            <th>Name (DB)</th>
                            <th>Type</th>
                            <th>Required?</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($fields as $field)
                        <tr>
                            <td>{{ $field->order }}</td>
                            <td class="fw-bold">{{ $field->label }}</td>
                            <td><code>{{ $field->name }}</code></td>
                            <td>
                                <span class="badge bg-secondary">{{ $field->type }}</span>
                                @if($field->options)
                                    <br><small class="text-muted">{{ implode(', ', $field->options) }}</small>
                                @endif
                            </td>
                            <td>
                                @if($field->is_required)
                                    <span class="badge bg-danger-subtle text-danger">Ya</span>
                                @else
                                    <span class="badge bg-light text-dark">Tidak</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('paket_belajar_fields.edit', $field->id) }}" class="btn btn-sm btn-light">Edit</a>
                                <form action="{{ route('paket_belajar_fields.destroy', $field->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus field ini? Data lama pada santri tidak akan terhapus namun tidak akan muncul lagi di form.')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">Belum ada field khusus.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>
