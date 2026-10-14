@php $f = $facility ?? null; @endphp
<div>
    <label>Nama</label><br>
    <input type="text" name="name" value="{{ old('name', $f?->name) }}">
    @error('name') <small style="color:red">{{ $message }}</small> @enderror
</div>
<div>
    <label>Icon (opsional)</label><br>
    <input type="text" name="icon" value="{{ old('icon', $f?->icon) }}">
    @error('icon') <small style="color:red">{{ $message }}</small> @enderror
</div>