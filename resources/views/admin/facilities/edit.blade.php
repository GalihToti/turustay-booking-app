@extends('layouts.site')

@section('title', 'Edit Fasilitas - TuruStay')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.facilities.index') }}">Fasilitas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>

        <div class="card shadow-sm">
            <div class="card-header bg-white fw-semibold">Edit Fasilitas</div>
            <div class="card-body">
                <form action="{{ route('admin.facilities.update', $facility) }}" method="POST">
                    @csrf @method('PUT')
                    @include('admin.facilities._form')
                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg"></i> Perbarui
                        </button>
                        <a href="{{ route('admin.facilities.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection