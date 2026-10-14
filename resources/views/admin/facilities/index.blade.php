<h1>Manajemen Fasilitas</h1>
@if (session('success')) <p style="color:green">{{ session('success') }}</p> @endif
@if (session('error')) <p style="color:red">{{ session('error') }}</p> @endif

<a href="{{ route('admin.facilities.create') }}">+ Tambah Fasilitas</a>

<table border="1" cellpadding="8">
    <tr><th>Nama</th><th>Icon</th><th>Aksi</th></tr>
    @forelse ($facilities as $facility)
        <tr>
            <td>{{ $facility->name }}</td>
            <td>{{ $facility->icon }}</td>
            <td>
                <a href="{{ route('admin.facilities.edit', $facility) }}">Edit</a> |
                <form action="{{ route('admin.facilities.destroy', $facility) }}" method="POST" style="display:inline"
                      onsubmit="return confirm('Hapus fasilitas ini?')">
                    @csrf @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="3">Belum ada fasilitas.</td></tr>
    @endforelse
</table>
{{ $facilities->links() }}