@extends('layouts.app')

@section('content')
    <!-- Google Font -->
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

        #logo-preview {
            margin-top: 10px;
            max-height: 150px;
            display: none;
        }
    </style>

    <div class="container mt-5">
        <div class="card-transparent">
            <h3 class="mb-4">Tambah Data Penerbangan</h3>

            <form method="POST" action="{{ route('flights.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- Scedule --}}
                <div class="mb-3">
                    <label for="schedule" class="form-label">Schedule</label>
                    <input type="time" name="schedule" id="schedule" class="form-control" required
                        value="{{ old('schedule') }}">
                </div>

                {{-- Logo Maskapai --}}
                <div class="mb-3">
                    <label for="logo" class="form-label">Airline</label>
                    <input type="file" name="logo" id="logo" class="form-control" accept="image/*" required
                        onchange="previewLogo(event)">
                    <img id="logo-preview" src="#" alt="Preview Logo">
                </div>

                {{-- Flight No --}}
                <div class="mb-3">
                    <label for="flight_no" class="form-label">Flight No</label>
                    <input type="text" name="flight_no" id="flight_no" class="form-control" required
                        placeholder="Contoh: GA123" value="{{ old('flight_no') }}">
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="on-schedule" {{ old('status') == 'on-schedule' ? 'selected' : '' }}>On-Schedule</option>
                        <option value="check-in" {{ old('status') == 'check-in' ? 'selected' : '' }}>Check-in</option>
                        <option value="boarding" {{ old('status') == 'boarding' ? 'selected' : '' }}>Boarding</option>
                        <option value="cancel" {{ old('status') == 'cancel' ? 'selected' : '' }}>Cancel</option>
                        <option value="delayed" {{ old('status') == 'delayed' ? 'selected' : '' }}>Delayed</option>
                        <option value="to-waiting-room" {{ old('status') == 'to-waiting-room' ? 'selected' : '' }}>To Waiting Room</option>
                    </select>
                </div>

                {{-- Destinasi --}}
                <div class="mb-3">
                    <label for="destinasi" class="form-label">Destinasi</label>
                    <select name="destinasi" id="destinasi" class="form-control" required>
                        <option value="ternate" {{ old('destinasi') == 'ternate' ? 'selected' : '' }}>Ternate</option>
                        <option value="labuha" {{ old('destinasi') == 'labuha' ? 'selected' : '' }}>Labuha</option>
                        <option value="manado" {{ old('destinasi') == 'manado' ? 'selected' : '' }}>Manado</option>
                    </select>
                </div>

                {{-- Tombol --}}
                <button type="submit" class="btn btn-success px-4">Simpan</button>
                <a href="{{ route('manage.flights') }}" class="btn btn-secondary px-4 ms-2">Kembali</a>
            </form>
        </div>
    </div>

    <script>
        function previewLogo(event) {
            const input = event.target;
            const preview = document.getElementById('logo-preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
