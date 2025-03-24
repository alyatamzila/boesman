<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Airline;


class FlightController extends Controller
{
    public function index()
    {
        $flights = Flight::with('airline')->orderBy('schedule')->get();
        // $flights = Flight::latest()->get();
        return view('admin.flights.index', compact('flights'));
    }

    public function create()
    {
        $airlines = Airline::all();
        return view('admin.flights.create', compact('airlines'));
        // return view('admin.flights.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'airline_id'  => 'required|exists:airlines,id',
            'flight_no' => 'required|string|max:50',
            'schedule' => 'required|date',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'destinasi' => 'required|in:ternate,manado,pusat',

        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        Flight::create([
            'airline_id' => $request->airline_id,
            'flight_no' => $request->flight_no,
            'schedule' => $request->schedule,
            'logo' => $logoPath,
            'destinasi' => $request->destinasi,
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
            'flight_no' => 'required|string|max:50',
            'schedule' => 'required|date',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'destinasi' => 'required|in:ternate,manado,pusat'
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
            'destinasi' => $request->destinasi,
            'logo' => $flight->logo,
        ]);

        return redirect()->route('manage.flights')->with('success', 'Data penerbangan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $flight = Flight::findOrFail($id);
        if ($flight->logo) {
            Storage::disk('public')->delete($flight->logo);
        }
        $flight->delete();

        return redirect()->route('manage.flights')->with('success', 'Data penerbangan berhasil dihapus.');
    }
}
