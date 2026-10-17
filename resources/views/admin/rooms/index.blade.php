<h1>Manajemen Kamar</h1>
@if (session('success')) <p style="color:green">{{ session('success') }}</p> @endif
@if (session('error')) <p style="color:red">{{ session('error') }}</p> @endif

<a href="{{ route('admin.rooms.create') }}">+ Tambah Kamar</a>

<table border="1" cellpadding="8">
    <tr>
        <th>No. Kamar</th>
        <th>Tipe</th>
        <th>Lantai</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    @forelse ($rooms as $room)
    <tr>
        <td>{{ $room->room_number }}</td>
        <td>{{ $room->roomType->name }}</td>
        <td>{{ $room->floor }}</td>
        <td>{{ $room->status }}</td>
        <td>
            <a href="{{ route('admin.rooms.edit', $room) }}">Edit</a> |
            <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" style="display:inline"
                onsubmit="return confirm('Hapus kamar ini?')">
                @csrf @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="5">Belum ada kamar.</td>
    </tr>
    @endforelse
</table>
{{ $rooms->links() }}