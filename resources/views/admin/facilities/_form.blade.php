@php $f = $facility ?? null; @endphp
<div class="mb-3">
    <label class="form-label" for="name">Nama</label>
    <input type="text" id="name" name="name" value="{{ old('name', $f?->name) }}"
           class="form-control @error('name') is-invalid @enderror" required>
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label class="form-label" for="icon">Icon (opsional)</label>
    <input type="text" id="icon" name="icon" value="{{ old('icon', $f?->icon) }}"
           class="form-control @error('icon') is-invalid @enderror"
           placeholder="Contoh: bi-wifi">
    @error('icon') <div class="invalid-feedback">{{ $message }}</div> @enderror
    <div class="form-text">Gunakan nama class <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a>, contoh: <code>bi-wifi</code></div>
</div>