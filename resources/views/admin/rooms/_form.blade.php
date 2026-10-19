@php $r = $room ?? null; @endphp
<div class="mb-3">
    <label class="form-label" for="room_type_id">Tipe Kamar</label>
    <select name="room_type_id" id="room_type_id"
            class="form-select @error('room_type_id') is-invalid @enderror" required>
        <option value="">-- Pilih tipe kamar --</option>
        @foreach ($roomTypes as $type)
            <option value="{{ $type->id }}" @selected(old('room_type_id', $r?->room_type_id) == $type->id)>{{ $type->name }}</option>
        @endforeach
    </select>
    @error('room_type_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label class="form-label" for="room_number">Nomor Kamar</label>
    <input type="text" id="room_number" name="room_number" value="{{ old('room_number', $r?->room_number) }}"
           class="form-control @error('room_number') is-invalid @enderror" required>
    @error('room_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label class="form-label" for="floor">Lantai</label>
    <input type="number" id="floor" name="floor" min="1" value="{{ old('floor', $r?->floor ?? 1) }}"
           class="form-control @error('floor') is-invalid @enderror" required>
    @error('floor') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label class="form-label" for="status">Status</label>
    <select name="status" id="status"
            class="form-select @error('status') is-invalid @enderror" required>
        @foreach (['available' => 'Tersedia', 'maintenance' => 'Perawatan'] as $value => $label)
            <option value="{{ $value }}" @selected(old('status', $r?->status ?? 'available') === $value)>{{ $label }}</option>
        @endforeach
    </select>
    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>