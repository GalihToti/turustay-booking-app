@php
    $rt = $roomType ?? null;
    $selected = old('facilities', $rt ? $rt->facilities->pluck('id')->all() : []);
@endphp

<div>
    <label>Nama</label><br>
    <input type="text" name="name" value="{{ old('name', $rt?->name) }}">
    @error('name') <small style="color:red">{{ $message }}</small> @enderror
</div>
<div>
    <label>Deskripsi</label><br>
    <textarea name="description" rows="4">{{ old('description', $rt?->description) }}</textarea>
    @error('description') <small style="color:red">{{ $message }}</small> @enderror
</div>
<div>
    <label>Harga per Malam</label><br>
    <input type="number" step="0.01" name="price_per_night" value="{{ old('price_per_night', $rt?->price_per_night) }}">
    @error('price_per_night') <small style="color:red">{{ $message }}</small> @enderror
</div>
<div>
    <label>Kapasitas</label><br>
    <input type="number" name="capacity" value="{{ old('capacity', $rt?->capacity) }}">
    @error('capacity') <small style="color:red">{{ $message }}</small> @enderror
</div>
<div>
    <label>Gambar</label><br>
    @if ($rt?->image)
        <img src="{{ asset('storage/'.$rt->image) }}" width="120"><br>
    @endif
    <input type="file" name="image" accept="image/*">
    @error('image') <small style="color:red">{{ $message }}</small> @enderror
</div>
<div>
    <label>Fasilitas</label><br>
    @foreach ($facilities as $facility)
        <label>
            <input type="checkbox" name="facilities[]" value="{{ $facility->id }}" @checked(in_array($facility->id, $selected))>
            {{ $facility->name }}
        </label><br>
    @endforeach
</div>