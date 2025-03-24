@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
    .glass {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 1rem;
        padding: 2rem;
        color: #fff;
    }
    .table thead {
        background-color: rgba(255, 255, 255, 0.2);
        color: #070707;
    }
    .table td, .table th {
        color: #0f0e0e;
    }
    .running-text {
        background: rgba(0, 0, 0, 0.5);
        color: rgb(247, 247, 244);
        padding: 5px;
        font-weight: bold;
        font-size: 1.2rem;
        border-radius: 0.5rem;
    }
    .mb-4{
        font-weight: bold;
    }
</style>

<div class="container mt-4">
    <div class="glass">
        <h3 class="mb-4">🛫 Jadwal Penerbangan Hari Ini</h3>

        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Flight No</th>
                        <th>Jadwal</th>
                        <th>Destinasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($flights as $flight)
                        <tr>
                            <td>
                                @if($flight->airline && $flight->airline->logo)
                                    <img src="{{ asset('storage/' . $flight->airline->logo) }}" width="70">
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                            <td>{{ $flight->flight_no }}</td>
                            <td>{{ \Carbon\Carbon::parse($flight->schedule)->format('d M Y - H:i') }}</td>
                            <td>{{ ucfirst($flight->destinasi) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Running Text di bawah --}}
    <div class="running-text mt-4">
        <marquee behavior="scroll" direction="left">
            {{ $runningText ?? 'Selamat datang di jadwal penerbangan kami!' }}
        </marquee>
    </div>
</div>
@endsection
