<h1>Tambah Fasilitas</h1>
<form action="{{ route('admin.facilities.store') }}" method="POST">
    @csrf
    @include('admin.facilities._form')
    <br>
    <button type="submit">Simpan</button>
    <a href="{{ route('admin.facilities.index') }}">Batal</a>
</form>