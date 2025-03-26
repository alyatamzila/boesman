@extends('layouts.app')

@section('content')

{{-- Import Google Font --}}
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
        color: #f8f9fa;
        font-weight: 500;
    }
    h3 {
        font-weight: 600;
        color: #fff;
    }
    .form-control {
        background-color: rgba(255, 255, 255, 0.2);
        border: none;
        color: #fff;
    }
    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.8);
    }
    .form-control:focus {
        background-color: rgba(255, 255, 255, 0.3);
        color: #fff;
    }
    .btn {
        border-radius: 30px;
        font-weight: 500;
    }
</style>

<div class="container mt-5">
    <div class="glass-card">
        <h3 class="mb-4">Edit Data Admin</h3>

        <form method="POST" action="{{ route('admin.update', $admin->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama Admin</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $admin->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Admin</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $admin->email) }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password Baru <small class="text-light">(Opsional, isi jika ingin mengganti)</small></label>
                <input type="password" name="password" id="password" class="form-control" required placeholder="Minimal 6 karakter">
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required placeholder="Konfirmasi Password">
            </div>

            <button type="submit" class="btn btn-success px-4">Simpan Perubahan</button>
            <a href="{{ route('admin.manage') }}" class="btn btn-secondary px-4">Batal</a>
        </form>
    </div>
</div>
@endsection
