@extends('layouts.app')

@section('content')

{{-- Import Google Font --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
    .glass-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
        color: #fff;
        padding: 2rem;
    }
    label {
        color: #e9ecef;
        font-weight: 500;
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
    .form-control option {
        color: #000;
        background-color: #fff;
    }
    h3 {
        font-weight: 600;
        color: #fff;
    }
    .btn-primary, .btn-rounded {
        border-radius: 30px;
        padding: 10px 30px;
        font-weight: 600;
    }
</style>

<div class="container mt-5">
    <div class="glass-card">
        <h3 class="mb-4">🛬 Edit Data Penerbangan</h3>

        <form method="POST" action="{{ route('flights.update', $flight->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Logo --}}
            <div class="mb-3">
                <label for="logo" class="form-label">Logo Maskapai</label><br>
                @if($flight->logo)
                    <img src="{{ asset('storage/' . $flight->logo) }}" width="100" class="mb-2 rounded shadow-sm">
                @endif
                <input type="file" name="logo" id="logo" class="form-control">
            </div>

            {{-- Flight No --}}
            <div class="mb-3">
                <label for="flight_no" class="form-label">Flight No</label>
                <input type="text" name="flight_no" id="flight_no" class="form-control" value="{{ $flight->flight_no }}" required>
            </div>

            {{-- Schedule --}}
            <div class="mb-3">
                <label for="schedule" class="form-label">Schedule</label>
                <input type="datetime-local" name="schedule" id="schedule" class="form-control"
                       value="{{ date('Y-m-d\TH:i', strtotime($flight->schedule)) }}" required>
            </div>

            {{-- Destinasi --}}
            <div class="mb-3">
                <label for="destinasi" class="form-label">Destinasi</label>
                <select name="destinasi" id="destinasi" class="form-control">
                    <option value="ternate" {{ $flight->destinasi == 'ternate' ? 'selected' : '' }}>Ternate</option>
                    <option value="manado" {{ $flight->destinasi == 'manado' ? 'selected' : '' }}>Manado</option>
                    <option value="pusat" {{ $flight->destinasi == 'pusat' ? 'selected' : '' }}>Kunjungan dari Pusat</option>
                </select>
            </div>

            {{-- Tombol Aksi --}}
            <button type="submit" class="btn btn-primary mt-3">💾 Update</button>
            <a href="{{ route('manage.flights') }}" class="btn btn-secondary mt-3 btn-rounded">
                Kembali
            </a>
        </form>
    </div>
</div>
@endsection
