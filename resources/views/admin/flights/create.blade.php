@extends('layouts.app')

@section('content')

{{-- Import Font --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
    .card-transparent {
        background-color: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        padding: 2rem;
        color: #fff;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }
    .card-transparent h3 {
        font-weight: 600;
        color: #fff;
    }
    label {
        color: #e9ecef;
        font-weight: 500;
    }
    .form-control {
        background-color: rgba(255, 255, 255, 0.3);
        border: none;
        color: #fff;
    }
    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.8);
    }
    .form-control:focus {
        background-color: rgba(255, 255, 255, 0.4);
        color: #fff;
    }
    .form-control option {
        color: #000;
        background-color: #fff;
    }
</style>

<div class="container mt-5">
    <div class="card-transparent">
        <h3 class="mb-4">🛫 Tambah Data Penerbangan</h3>

        {{-- Tampilkan error jika ada --}}
        {{-- @if($errors->any())
            <div class="alert alert-danger text-dark">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <form method="POST" action="{{ route('flights.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- Maskapai --}}
            <div class="mb-3">
                <label for="airline_id" class="form-label">Maskapai</label>
                <select name="airline_id" id="airline_id" class="form-control" required>
                    <option value="" disabled {{ old('airline_id') ? '' : 'selected' }}>Pilih Maskapai</option>
                    @foreach($airlines as $airline)
                        <option value="{{ $airline->id }}" {{ old('airline_id') == $airline->id ? 'selected' : '' }}>
                            {{ $airline->name }}
                        </option>
                    @endforeach
                </select>
            </div>


            {{-- Logo --}}
            <div class="mb-3">
                <label for="logo" class="form-label">Logo Maskapai</label>
                <input type="file" name="logo" id="logo" class="form-control">
            </div>

            {{-- Flight No --}}
            <div class="mb-3">
                <label for="flight_no" class="form-label">Flight No</label>
                <input type="text" name="flight_no" id="flight_no" class="form-control" required placeholder="Contoh: GA123" value="{{ old('flight_no') }}">
            </div>

            {{-- Schedule --}}
            <div class="mb-3">
                <label for="schedule" class="form-label">Schedule</label>
                <input type="datetime-local" name="schedule" id="schedule" class="form-control" required value="{{ old('schedule') }}">
            </div>

            {{-- Destinasi --}}
            <div class="mb-3">
                <label for="destinasi" class="form-label">Destinasi</label>
                <select name="destinasi" id="destinasi" class="form-control">
                    <option value="ternate" {{ old('destinasi') == 'ternate' ? 'selected' : '' }}>Ternate</option>
                    <option value="manado" {{ old('destinasi') == 'manado' ? 'selected' : '' }}>Manado</option>
                    <option value="pusat" {{ old('destinasi') == 'pusat' ? 'selected' : '' }}>Kunjungan dari Pusat</option>
                </select>
            </div>

            {{-- Tombol --}}
            <button type="submit" class="btn btn-success px-4">💾 Simpan</button>
            <a href="{{ route('manage.flights') }}" class="btn btn-secondary px-4 ms-2">Kembali</a>
        </form>
    </div>
</div>

@endsection
