<h1>Tambah Kamar</h1>
<form action="{{ route('admin.rooms.store') }}" method="POST">
    @csrf
    @include('admin.rooms._form')
    <br>
    <button type="submit">Simpan</button>
    <a href="{{ route('admin.rooms.index') }}">Batal</a>
</form>