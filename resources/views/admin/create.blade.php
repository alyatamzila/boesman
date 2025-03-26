@extends('layouts.app')

@section('content')

{{-- Import Font Modern --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(12px);
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        color: #fff;
    }

    label {
        font-weight: 500;
        color: #f8f9fa;
    }

    h3 {
        font-weight: 600;
        color: #ffffff;
    }

    .form-control {
        background-color: rgba(255, 255, 255, 0.15);
        border: none;
        color: #fff;
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.8);
    }

    .form-control:focus {
        background-color: rgba(255, 255, 255, 0.25);
        color: #fff;
    }

    .btn {
        border-radius: 5px;
        font-weight: 500;
    }

    .alert-danger {
        background-color: rgba(255, 0, 0, 0.1);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
</style>

<div class="container mt-5">
    <div class="glass-card">

        <h3 class="mb-4">Tambah Admin Baru</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>⚠️ Ups!</strong> Ada kesalahan saat input data:
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.store') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama Admin</label>
                <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}" placeholder="Masukkan nama lengkap">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Admin</label>
                <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}" placeholder="contoh@gmail.com">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required placeholder="Minimal 6 karakter">
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required placeholder="Konfirmasi Password">
            </div>

            <button type="submit" class="btn btn-success px-4">Simpan</button>
            <a href="{{ route('admin.index') }}" class="btn btn-secondary px-4">Kembali</a>
        </form>
    </div>
</div>
@endsection
