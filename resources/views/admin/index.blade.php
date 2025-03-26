@extends('layouts.app')

@section('content')

{{-- Import Google Font --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
    .transparent-card {
        background-color: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        padding: 2rem;
        color: #fff;
    }
    .table {
        background-color: transparent;
    }

    .table thead {
        background-color: rgba(255, 255, 255, 0.15);
    }

    .table th,
    .table td {
        color: #ffffff;
        background-color: transparent;
        vertical-align: middle;
    }

    .table tbody tr {
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }
    .btn-primary, .btn-warning, .btn-danger, .btn-secondary {
        border-radius: 25px;
        font-weight: 500;
    }
</style>

<div class="container mt-5">
    <div class="transparent-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Daftar Admin</h2>
            <a href="{{ route('admin.create') }}" class="btn btn-primary">+ Tambah Admin</a>
        </div>

        {{-- @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show text-dark" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif --}}

        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Nama Admin</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $admin)
                        <tr>
                            <td class="fw-semibold">{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>
                                <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-warning btn-sm me-1">✏️ Edit</a>
                                <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">🗑️Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
                {{ $admins->links('pagination::bootstrap-5') }}
            </div>
        </div>
        {{-- Tombol Kembali --}}
        <div class="mt-4">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary px-4 ms-2 btn-rounded">Kembali</a>
        </div>
    </div>
</div>

@endsection
