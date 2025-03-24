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

    .table thead {
        background-color: rgba(0, 0, 0, 0.1);
        color: #0a0707;
    }

    .table td, .table th {
        vertical-align: middle;
        color: #0e0808;
    }

    .btn-primary, .btn-warning, .btn-danger, .btn-secondary {
        border-radius: 25px;
        font-weight: 500;
    }
</style>

<div class="container mt-5">
    <div class="transparent-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">✈️ Daftar Penerbangan</h2>
            <a href="{{ route('flights.create') }}" class="btn btn-primary">+ Tambah Penerbangan</a>
        </div>

        {{-- @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show text-dark" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif --}}

        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle text-center">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Flight No</th>
                        <th>Jadwal</th>
                        <th>Destinasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($flights as $flight)
                        <tr>
                            <td>
                                @if($flight->airline && $flight->airline->logo)
                                    <img src="{{ asset('storage/' . $flight->airline->logo) }}" width="80" class="rounded shadow-sm">
                                @elseif($flight->airline)
                                    <span class="text-muted">{{ $flight->airline->name }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="fw-semibold">{{ $flight->flight_no }}</td>
                            <td>{{ \Carbon\Carbon::parse($flight->schedule)->format('d M Y - H:i') }}</td>
                            <td>{{ ucfirst($flight->destinasi) }}</td>
                            <td>
                                <a href="{{ route('flights.edit', $flight->id) }}" class="btn btn-warning btn-sm me-1">✏️ Edit</a>
                                <form action="{{ route('flights.destroy', $flight->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">🗑️ Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Tombol Kembali --}}
        <div class="mt-4">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary px-4 ms-2">Kembali</a>
        </div>
    </div>
</div>
@endsection
