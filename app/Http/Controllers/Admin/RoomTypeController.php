<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomTypeController extends Controller
{
    private function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price_per_night' => ['required', 'numeric', 'min:0'],
            'capacity' => ['required', 'integer', 'min:1'],
            'image' => ['nullable', 'image', 'max:2048'],
            'facilities' => ['nullable', 'array'],
            'facilities.*' => ['exists:facilities,id'],
        ];
    }

    public function index()
    {
        $roomTypes = RoomType::latest()->paginate(10);
        return view('admin.room-types.index', compact('roomTypes'));
    }

    public function create()
    {
        $facilities = Facility::orderBy('name')->get();
        return view('admin.room-types.create', compact('facilities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());
        $facilityIds = $validated['facilities'] ?? [];
        unset($validated['facilities']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('room-types', 'public');
        }

        $roomType = RoomType::create($validated);
        $roomType->facilities()->sync($facilityIds);

        return redirect()->route('admin.room-types.index')->with('success', 'Tipe kamar berhasil ditambahkan.');
    }

    public function show(RoomType $roomType)
    {
        $roomType->load('facilities');
        return view('admin.room-types.show', compact('roomType'));
    }

    public function edit(RoomType $roomType)
    {
        $facilities = Facility::orderBy('name')->get();
        $roomType->load('facilities');
        return view('admin.room-types.edit', compact('roomType', 'facilities'));
    }

    public function update(Request $request, RoomType $roomType)
    {
        $validated = $request->validate($this->rules());
        $facilityIds = $validated['facilities'] ?? [];
        unset($validated['facilities']);

        if ($request->hasFile('image')) {
            if ($roomType->image) {
                Storage::disk('public')->delete($roomType->image);
            }
            $validated['image'] = $request->file('image')->store('room-types', 'public');
        }

        $roomType->update($validated);
        $roomType->facilities()->sync($facilityIds);

        return redirect()->route('admin.room-types.index')->with('success', 'Tipe kamar berhasil diperbarui.');
    }

    public function destroy(RoomType $roomType)
    {
        if ($roomType->rooms()->exists()) {
            return back()->with('error', 'Tipe kamar tidak bisa dihapus karena masih memiliki kamar.');
        }

        if ($roomType->image) {
            Storage::disk('public')->delete($roomType->image);
        }

        $roomType->delete();

        return redirect()->route('admin.room-types.index')->with('success', 'Tipe kamar berhasil dihapus.');
    }
}