@extends('layouts.app')

@section('content')

{{-- Import Google Font --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


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
            <h2 class="fw-bold">Daftar Penerbangan</h2>
            <a href="{{ route('flights.create') }}" class="btn btn-primary">+ Tambah Penerbangan</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle text-center">
                <thead>
                    <tr>
                        <th>Schedule</th>
                        <th>Airline</th>
                        <th>Flight No</th>
                        <th>Status</th>
                        <th>Destinasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($flights as $flight)
                        <tr>
                            {{-- Schedule (manual input jadwal saja) --}}
                            <td>{{ \Carbon\Carbon::parse($flight->schedule)->format('d M Y - H:i') }}</td>

                            {{-- Airline (nama, bukan logo) --}}
                            <td>
                                @if($flight->logo)
                                    <img src="{{ asset('storage/' . $flight->logo) }}" alt="Logo Maskapai" style="height: 40px;">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            <td class="fw-semibold">{{ $flight->flight_no }}</td>

                            {{-- Status --}}
                            <td>
                                <span class="badge
                                    @if($flight->status == 'check-in') bg-info
                                    @elseif($flight->status == 'boarding') bg-warning
                                    @elseif($flight->status == 'cancel') bg-danger
                                    @elseif($flight->status == 'delayed') bg-secondary
                                    @else bg-success
                                    @endif">
                                    {{ ucfirst($flight->status ?? 'on-schedule') }}
                                </span>
                            </td>

                            {{-- Destinasi --}}
                            <td>{{ ucfirst($flight->destinasi) }}</td>

                            {{-- Aksi --}}
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
            <div class="d-flex justify-content-center mt-4">
                {{ $flights->links('pagination::bootstrap-5') }}
            </div>
        </div>

        {{-- Tombol Kembali --}}
        <div class="mt-4">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary px-4 ms-2">Kembali</a>
        </div>
    </div>
</div>


@endsection
