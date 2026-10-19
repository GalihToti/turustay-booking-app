@php
    $rt = $roomType ?? null;
    $selected = old('facilities', $rt ? $rt->facilities->pluck('id')->all() : []);
@endphp

<div class="mb-3">
    <label class="form-label" for="name">Nama</label>
    <input type="text" id="name" name="name" value="{{ old('name', $rt?->name) }}"
           class="form-control @error('name') is-invalid @enderror" required>
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label class="form-label" for="description">Deskripsi</label>
    <textarea id="description" name="description" rows="4"
              class="form-control @error('description') is-invalid @enderror">{{ old('description', $rt?->description) }}</textarea>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label" for="price_per_night">Harga per Malam (Rp)</label>
        <input type="number" id="price_per_night" name="price_per_night" step="0.01" min="0"
               value="{{ old('price_per_night', $rt?->price_per_night) }}"
               class="form-control @error('price_per_night') is-invalid @enderror" required>
        @error('price_per_night') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label" for="capacity">Kapasitas (orang)</label>
        <input type="number" id="capacity" name="capacity" min="1"
               value="{{ old('capacity', $rt?->capacity) }}"
               class="form-control @error('capacity') is-invalid @enderror" required>
        @error('capacity') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>
<div class="mb-3">
    <label class="form-label" for="image">Gambar</label>
    @if ($rt?->image)
        <div class="mb-2">
            <img src="{{ asset('storage/'.$rt->image) }}" width="120" class="rounded border">
        </div>
    @endif
    <input type="file" id="image" name="image" accept="image/*"
           class="form-control @error('image') is-invalid @enderror">
    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label class="form-label d-block">Fasilitas</label>
    <div class="row">
        @foreach ($facilities as $facility)
            <div class="col-sm-6 col-md-4">
                <div class="form-check mb-2">
                    <input type="checkbox" name="facilities[]" value="{{ $facility->id }}"
                           id="fac_{{ $facility->id }}"
                           class="form-check-input"
                           @checked(in_array($facility->id, $selected))>
                    <label class="form-check-label" for="fac_{{ $facility->id }}">
                        @if ($facility->icon) <i class="bi {{ $facility->icon }}"></i> @endif
                        {{ $facility->name }}
                    </label>
                </div>
            </div>
        @endforeach
    </div>
</div>