<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class FlightController extends Controller
{
    public function index()
    {
        $flights = Flight::orderBy('schedule', 'asc')->paginate(6);
        return view('admin.flights.index', compact('flights'));
    }

    public function create()
    {
        return view('admin.flights.create'); // Tidak perlu ambil airlines
    }

    public function store(Request $request)
    {
        $request->validate([

            'status' => 'required|in:on-schedule,check-in,boarding,cancel,delayed',
            'flight_no' => 'required|string|max:50',
            'schedule' => 'required|date',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'destinasi' => 'required|in:ternate,labuha,manado',
        ]);

        $logoPath = $request->hasFile('logo')
            ? $request->file('logo')->store('logos', 'public')
            : null;

        Flight::create([

            'flight_no' => $request->flight_no,
            'schedule' => $request->schedule,
            'status' => $request->status,
            'destinasi' => $request->destinasi,
            'logo' => $logoPath,
        ]);

        return redirect()->route('manage.flights')->with('success', 'Data penerbangan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $flight = Flight::findOrFail($id);
        return view('admin.flights.edit', compact('flight'));
    }

    public function update(Request $request, $id)
    {
        $flight = Flight::findOrFail($id);

        $request->validate([
            'status' => 'required|in:on-schedule,check-in,boarding,cancel,delayed',
            'flight_no' => 'required|string|max:50',
            'schedule' => 'required|date',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'destinasi' => 'required|in:ternate,labuha,manado',
        ]);

        if ($request->hasFile('logo')) {
            if ($flight->logo) {
                Storage::disk('public')->delete($flight->logo);
            }
            $flight->logo = $request->file('logo')->store('logos', 'public');
        }

        $flight->update([

            'flight_no' => $request->flight_no,
            'schedule' => $request->schedule,
            'status' => $request->status,
            'destinasi' => $request->destinasi,
            'logo' => $flight->logo,
        ]);

        return redirect()->route('manage.flights')->with('success', 'Data penerbangan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Log::info('Memanggil method destroy untuk ID: ' . $id);

        $flight = Flight::findOrFail($id);
        if ($flight->logo) {
            Log::info("Deleting logo: " . $flight->logo);
            Storage::disk('public')->delete($flight->logo);
        }
        $flight->delete();
        Log::info("Deleted flight ID: " . $id);

        return redirect()->route('manage.flights')->with('success', 'Data penerbangan berhasil dihapus.');
    }
}
