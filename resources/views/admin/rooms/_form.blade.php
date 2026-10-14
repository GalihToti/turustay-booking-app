@php $r = $room ?? null; @endphp
<div>
    <label>Tipe Kamar</label><br>
    <select name="room_type_id">
        <option value="">-- pilih --</option>
        @foreach ($roomTypes as $type)
            <option value="{{ $type->id }}" @selected(old('room_type_id', $r?->room_type_id) == $type->id)>{{ $type->name }}</option>
        @endforeach
    </select>
    @error('room_type_id') <small style="color:red">{{ $message }}</small> @enderror
</div>
<div>
    <label>Nomor Kamar</label><br>
    <input type="text" name="room_number" value="{{ old('room_number', $r?->room_number) }}">
    @error('room_number') <small style="color:red">{{ $message }}</small> @enderror
</div>
<div>
    <label>Lantai</label><br>
    <input type="number" name="floor" min="1" value="{{ old('floor', $r?->floor ?? 1) }}">
    @error('floor') <small style="color:red">{{ $message }}</small> @enderror
</div>
<div>
    <label>Status</label><br>
    <select name="status">
        @foreach (['available' => 'Tersedia', 'maintenance' => 'Perawatan'] as $value => $label)
            <option value="{{ $value }}" @selected(old('status', $r?->status ?? 'available') === $value)>{{ $label }}</option>
        @endforeach
    </select>
    @error('status') <small style="color:red">{{ $message }}</small> @enderror
</div>