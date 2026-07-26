<x-layouts.app title="Master Data Fee">
    <div class="card">
        <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
            <h5 class="header-title mb-0">Master Data Fee (Mukafaah)</h5>
            @can('fees:create')
            <a href="{{ route('fees.create') }}" class="btn btn-primary btn-sm">Tambah Fee</a>
            @endcan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama / Deskripsi Paket</th>
                            <th>Nominal (Rp)</th>
                            @canany(['fees:edit', 'fees:delete'])
                            <th class="text-end">Aksi</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fees as $fee)
                        <tr>
                            <td>{{ $fee->id }}</td>
                            <td class="fw-bold">{{ $fee->nama }}</td>
                            <td>Rp {{ number_format($fee->nominal, 0, ',', '.') }}</td>
                            @canany(['fees:edit', 'fees:delete'])
                            <td class="text-end">
                                @can('fees:edit')
                                <a href="{{ route('fees.edit', $fee->id) }}" class="btn btn-sm btn-light">Edit</a>
                                @endcan
                                @can('fees:delete')
                                <form action="{{ route('fees.destroy', $fee->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus fee ini? Paket Belajar yang terkait akan kehilangan referensi fee-nya.')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                                @endcan
                            </td>
                            @endcanany
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>
