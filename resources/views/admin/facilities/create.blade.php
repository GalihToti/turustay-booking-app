@extends('layouts.site')

@section('title', 'Tambah Fasilitas - TuruStay')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.facilities.index') }}">Fasilitas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav>

        <div class="card shadow-sm">
            <div class="card-header bg-white fw-semibold">Tambah Fasilitas</div>
            <div class="card-body">
                <form action="{{ route('admin.facilities.store') }}" method="POST">
                    @csrf
                    @include('admin.facilities._form')
                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg"></i> Simpan
                        </button>
                        <a href="{{ route('admin.facilities.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection