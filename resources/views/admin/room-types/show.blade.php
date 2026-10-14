<h1>{{ $roomType->name }}</h1>
@if ($roomType->image)<img src="{{ asset('storage/'.$roomType->image) }}" width="300">@endif
<p>{{ $roomType->description ?? '-' }}</p>
<p>Harga per malam: Rp{{ number_format((float) $roomType->price_per_night, 0, ',', '.') }}</p>
<p>Kapasitas: {{ $roomType->capacity }} orang</p>
<p>Fasilitas: {{ $roomType->facilities->pluck('name')->join(', ') ?: '-' }}</p>
<a href="{{ route('admin.room-types.edit', $roomType) }}">Edit</a> |
<a href="{{ route('admin.room-types.index') }}">Kembali</a>