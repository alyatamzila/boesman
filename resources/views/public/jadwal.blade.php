@extends('layouts.app')

@section('content')
    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            font-size: 1.1rem;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            color: #ffffff;
        }

        .table {
            background-color: transparent;
        }

        .table thead {
            background-color: rgba(255, 255, 255, 0.15);
        }

        .table thead th {
            font-size: 1.3rem;
            font-weight: 600;
        }

        .table th,
        .table td {
            color: #ffffff;
            background-color: transparent;
            vertical-align: middle;
            font-size: 1.2rem;
            padding: 12px 16px;
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

        .sub-info {
            font-size: 1rem;
            font-weight: normal;
            color: #e0e0e0;
            display: block;
            margin-top: 0.2rem;
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

    <div class="container">
        <div id="flight-table-container">
            {{-- Initial Load --}}
            <div class="glass-card">
                <div class="table-wrapper">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Flight</th>
                                <th>Schedule</th>
                                <th>Destinasi</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($flights as $flight)
                                <tr>
                                    <td class="d-flex align-items-center justify-content-center">
                                        <img src="{{ asset('storage/' . $flight->logo) }}" alt="Logo Airline"
                                            style="margin-right: 10px; max-width:100px; max-height:100px; object-fit:contain;">
                                        <span class="fw-semibold">{{ $flight->flight_no }}</span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($flight->schedule)->format('H:i') }}</td>
                                    <td>{{ ucfirst($flight->destinasi) }}</td>
                                    <td>
                                        <span
                                            class="badge
                                            @if ($flight->status == 'check-in') bg-info
                                            @elseif($flight->status == 'boarding') bg-warning
                                            @elseif($flight->status == 'cancel') bg-danger
                                            @elseif($flight->status == 'delayed') bg-secondary
                                            @elseif($flight->status == 'to-waiting-room') bg-black
                                            @else bg-success @endif">
                                            {{ ucfirst($flight->status ?? 'on-schedule') }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="running-text-bar d-flex justify-content-between align-items-center">
            <marquee behavior="scroll" direction="left" scrollamount="6" class="flex-grow-1">
                {{ DB::table('runningtexts')->where('key', 'running_text')->value('value') }}
            </marquee>
            <div class="text-white ms-3 d-flex align-items-center"
                style="white-space: nowrap; background-color: yellow; padding: 5px; border-radius: 5px;">
                <span id="realtime-date" class="fw-semibold me-2" style="font-size: 1rem; color: black;"></span>
                <span style="color: black;">|</span>
                <span id="realtime-clock" class="fw-semibold ms-2" style="font-size: 1rem; color: black;"></span>
            </div>
        </div>
    </div>

    <script>
        function updateClockAndDate() {
            const now = new Date();

            const jam = now.getHours().toString().padStart(2, '0');
            const menit = now.getMinutes().toString().padStart(2, '0');
            const detik = now.getSeconds().toString().padStart(2, '0');
            document.getElementById('realtime-clock').innerText = `${jam}:${menit}:${detik}`;

            const options = {
                weekday: 'long',
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            };
            const tanggal = now.toLocaleDateString('id-ID', options);
            document.getElementById('realtime-date').innerText = tanggal;
        }

        setInterval(updateClockAndDate, 1000);
        updateClockAndDate();

        // Auto Slider Pagination
        let currentPage = 1;
        const totalPages = {{ $flights->lastPage() }};
        const delayInSeconds = 10;

        function loadPage(page) {
            $.ajax({
                url: `{{ route('public.jadwal') }}?page=${page}`,
                type: 'GET',
                success: function(response) {
                    // Ambil bagian table dari response
                    const html = $(response).find("#flight-table-container").html();
                    $("#flight-table-container").html(html);
                }
            });
        }

        setInterval(() => {
            currentPage++;
            if (currentPage > totalPages) currentPage = 1;
            loadPage(currentPage);
        }, delayInSeconds * 1000);
    </script>
@endsection
