@extends('layouts.site')

@section('title', 'Manajemen Fasilitas - TuruStay')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Manajemen Fasilitas</h2>
    <a href="{{ route('admin.facilities.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg"></i> Tambah Fasilitas
    </a>
</div>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Nama</th>
                    <th>Icon</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($facilities as $facility)
                <tr>
                    <td class="fw-semibold">
                        @if ($facility->icon) <i class="bi {{ $facility->icon }} me-1"></i> @endif
                        {{ $facility->name }}
                    </td>
                    <td><code>{{ $facility->icon ?? '-' }}</code></td>
                    <td class="text-end">
                        <div class="btn-group" role="group">
                            <a href="{{ route('admin.facilities.edit', $facility) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('admin.facilities.destroy', $facility) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Hapus fasilitas ini?')">
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
                    <td colspan="3" class="text-center text-muted py-4">
                        <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                        Belum ada fasilitas.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $facilities->links() }}
</div>
@endsection