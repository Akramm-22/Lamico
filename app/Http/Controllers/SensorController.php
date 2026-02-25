<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $sensors = Sensor::when($search, function ($query, $search) {
            $query->where('nama_sensor', 'like', "%$search%");
        })->latest()->get();

        return view('sensor.index', compact('sensors', 'search'));
    }

    public function create()
    {
        return view('sensor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sensor' => 'required',
            'data' => 'required|numeric'
        ]);

        Sensor::create($request->all());

        return redirect()->route('sensor.index')
            ->with('success', 'Data sensor berhasil ditambahkan');
    }

    public function edit(Sensor $sensor)
    {
        return view('sensor.edit', compact('sensor'));
    }

    public function update(Request $request, Sensor $sensor)
    {
        $request->validate([
            'nama_sensor' => 'required',
            'data' => 'required|numeric'
        ]);

        $sensor->update($request->all());

        return redirect()->route('sensor.index')
            ->with('success', 'Data sensor berhasil diupdate');
    }

    public function destroy(Sensor $sensor)
    {
        $sensor->delete();

        return redirect()->route('sensor.index')
            ->with('success', 'Data sensor berhasil dihapus');
    }
}

