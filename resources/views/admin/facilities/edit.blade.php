<h1>Edit Fasilitas</h1>
<form action="{{ route('admin.facilities.update', $facility) }}" method="POST">
    @csrf @method('PUT')
    @include('admin.facilities._form')
    <br>
    <button type="submit">Perbarui</button>
    <a href="{{ route('admin.facilities.index') }}">Batal</a>
</form>