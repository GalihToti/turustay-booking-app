@extends('layouts.site')

@section('title', 'Manajemen Tipe Kamar - TuruStay')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Manajemen Tipe Kamar</h2>
    <a href="{{ route('admin.room-types.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg"></i> Tambah Tipe Kamar
    </a>
</div>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Harga/Malam</th>
                    <th>Kapasitas</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roomTypes as $roomType)
                <tr>
                    <td>
                        @if ($roomType->image)
                            <img src="{{ asset('storage/'.$roomType->image) }}" width="80" class="rounded">
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td class="fw-semibold">{{ $roomType->name }}</td>
                    <td>Rp {{ number_format((float) $roomType->price_per_night, 0, ',', '.') }}</td>
                    <td>{{ $roomType->capacity }} orang</td>
                    <td class="text-end">
                        <div class="btn-group" role="group">
                            <a href="{{ route('admin.room-types.show', $roomType) }}" class="btn btn-sm btn-outline-info">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                            <a href="{{ route('admin.room-types.edit', $roomType) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('admin.room-types.destroy', $roomType) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Hapus tipe kamar ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                        Belum ada data tipe kamar.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $roomTypes->links() }}
</div>
@endsection