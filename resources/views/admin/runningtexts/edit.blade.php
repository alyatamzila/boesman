@extends('layouts.app')

@section('content')

{{-- Google Font --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
    .glass-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(12px);
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
        color: #ffffff;
    }
    label {
        font-weight: 600;
        color: #f8f9fa;
    }
    .form-control {
        border-radius: 12px;
    }
    .btn-rounded {
        border-radius: 5px;
        padding: 10px 25px;
        font-weight: 500;
    }
    .form-title {
        font-weight: bold;
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
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
    .form-control option {
        color: #000;
        background-color: #fff;
    }
</style>

<div class="container mt-5 d-flex justify-content-center">
    <div class="col-md-8">
        <div class="glass-card">
            <h2 class="form-title text-center">Edit Running Text</h2>

            <form action="{{ route('admin.runningtexts.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="value" class="form-label">Teks Berjalan</label>
                    <input type="text" name="value" id="value" class="form-control"
                        placeholder="Masukkan teks berjalan..."
                        value="{{ old('value', $runningText) }}" required>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success btn-rounded">
                        Simpan
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary btn-rounded">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
