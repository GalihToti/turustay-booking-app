<h1>Tambah Tipe Kamar</h1>
<form action="{{ route('admin.room-types.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.room-types._form')
    <br>
    <button type="submit">Simpan</button>
    <a href="{{ route('admin.room-types.index') }}">Batal</a>
</form>