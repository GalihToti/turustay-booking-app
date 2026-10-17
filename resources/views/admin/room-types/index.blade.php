<h1>Manajemen Tipe Kamar</h1>
@if (session('success')) <p style="color:green">{{ session('success') }}</p> @endif
@if (session('error')) <p style="color:red">{{ session('error') }}</p> @endif

<a href="{{ route('admin.room-types.create') }}">+ Tambah Tipe Kamar</a>

<table border="1" cellpadding="8">
    <tr>
        <th>Gambar</th>
        <th>Nama</th>
        <th>Harga/Malam</th>
        <th>Kapasitas</th>
        <th>Aksi</th>
    </tr>
    @forelse ($roomTypes as $roomType)
    <tr>
        <td>@if ($roomType->image)<img src="{{ asset('storage/'.$roomType->image) }}" width="80">@endif</td>
        <td>{{ $roomType->name }}</td>
        <td>Rp{{ number_format((float) $roomType->price_per_night, 0, ',', '.') }}</td>
        <td>{{ $roomType->capacity }} orang</td>
        <td>
            <a href="{{ route('admin.room-types.show', $roomType) }}">Detail</a> |
            <a href="{{ route('admin.room-types.edit', $roomType) }}">Edit</a> |
            <form action="{{ route('admin.room-types.destroy', $roomType) }}" method="POST" style="display:inline"
                onsubmit="return confirm('Hapus tipe kamar ini?')">
                @csrf @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="5">Belum ada data tipe kamar.</td>
    </tr>
    @endforelse
</table>
{{ $roomTypes->links() }}