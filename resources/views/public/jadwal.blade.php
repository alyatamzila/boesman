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

    .btn-rounded {
        border-radius: 25px;
        padding: 10px 25px;
        font-weight: 500;
    }

    .form-title {
        font-weight: bold;
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        color: #fff;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .running-text-bar {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background: rgba(0, 0, 0, 0.8);
        color: yellow;
        font-weight: bold;
        padding: 5px 0;
        z-index: 999;
    }

    .running-text-bar marquee {
        font-size: 1.1rem;
    }
</style>

<div class="container mt-5">
    <div class="glass-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="form-title">Flight Information</h2>

            <div class="text-end text-white">
                <div id="realtime-clock" class="fw-semibold" style="font-size: 1rem;"></div>
                <div id="realtime-date" class="fw-semibold" style="font-size: 1rem;"></div>
            </div>

            <script>
                function updateClockAndDate() {
                    const now = new Date();

                    // Jam
                    const jam = now.getHours().toString().padStart(2, '0');
                    const menit = now.getMinutes().toString().padStart(2, '0');
                    const detik = now.getSeconds().toString().padStart(2, '0');
                    document.getElementById('realtime-clock').innerText = `${jam}:${menit}:${detik}`;

                    // Tanggal
                    const options = { day: '2-digit', month: 'long', year: 'numeric' };
                    const tanggal = now.toLocaleDateString('id-ID', options);
                    document.getElementById('realtime-date').innerText = tanggal;
                }

                setInterval(updateClockAndDate, 1000);
                updateClockAndDate(); // Initial call
            </script>

        </div>
        <div class="table-wrapper">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Schedule</th>
                        <th>Airline</th>
                        <th>Flight No</th>
                        <th>Destinasi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($flights as $flight)
                        <tr>
                            {{-- Jadwal --}}
                            <td>{{ \Carbon\Carbon::parse($flight->schedule)->format('d M Y - H:i') }}</td>

                            {{-- Airline Logo --}}
                            <td>
                                @if($flight->logo)
                                    <img src="{{ asset('storage/' . $flight->logo) }}" alt="Logo Airline" style="height: 60px;">
                                @else
                                    -
                                @endif
                            </td>

                            {{-- Flight No --}}
                            <td class="fw-semibold">{{ $flight->flight_no }}</td>

                            {{-- Destinasi --}}
                            <td>{{ ucfirst($flight->destinasi) }}</td>

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
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $flights->links('pagination::bootstrap-5') }}
    </div>


    <div class="running-text-bar">
        <marquee behavior="scroll" direction="left" scrollamount="6">
            {{ DB::table('runningtexts')->where('key', 'running_text')->value('value') }}
        </marquee>
    </div>

</div>

@endsection
