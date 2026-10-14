<h1>Edit Kamar</h1>
<form action="{{ route('admin.rooms.update', $room) }}" method="POST">
    @csrf @method('PUT')
    @include('admin.rooms._form')
    <br>
    <button type="submit">Perbarui</button>
    <a href="{{ route('admin.rooms.index') }}">Batal</a>
</form>