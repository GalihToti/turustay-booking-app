@extends('layouts.site')

@section('title', 'Tambah Tipe Kamar - TuruStay')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.room-types.index') }}">Tipe Kamar</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav>

        <div class="card shadow-sm">
            <div class="card-header bg-white fw-semibold">Tambah Tipe Kamar</div>
            <div class="card-body">
                <form action="{{ route('admin.room-types.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('admin.room-types._form')
                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg"></i> Simpan
                        </button>
                        <a href="{{ route('admin.room-types.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection