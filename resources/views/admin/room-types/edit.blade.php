<h1>Edit Tipe Kamar</h1>
<form action="{{ route('admin.room-types.update', $roomType) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    @include('admin.room-types._form')
    <br>
    <button type="submit">Perbarui</button>
    <a href="{{ route('admin.room-types.index') }}">Batal</a>
</form>