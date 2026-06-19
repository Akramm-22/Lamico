<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    public function index()
    {
        $sensors = Sensor::latest()->paginate(5);
        return view('sensor.index', compact('sensors'));
    }

    public function create()
    {
        return view('sensor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sensor' => 'required|string|max:255',
            'data'        => 'required|numeric',
        ], [
            'nama_sensor.required' => 'Nama sensor wajib diisi.',
            'data.required'        => 'Data wajib diisi.',
            'data.numeric'         => 'Data harus berupa angka.',
        ]);

        Sensor::create($request->only('nama_sensor', 'data'));

        return redirect()->route('sensor.index')
            ->with('success', 'Berhasil menambahkan data sensor');
    }

    public function edit(Sensor $sensor)
    {
        return view('sensor.edit', compact('sensor'));
    }

    public function update(Request $request, Sensor $sensor)
    {
        $request->validate([
            'nama_sensor' => 'required|string|max:255',
            'data'        => 'required|numeric',
        ], [
            'nama_sensor.required' => 'Nama sensor wajib diisi.',
            'data.required'        => 'Data wajib diisi.',
            'data.numeric'         => 'Data harus berupa angka.',
        ]);

        $sensor->update($request->only('nama_sensor', 'data'));

        return redirect()->route('sensor.index')
            ->with('success', 'Berhasil mengubah data sensor');
    }

    public function destroy(Sensor $sensor)
    {
        $sensor->delete();

        return redirect()->route('sensor.index')
            ->with('success', 'Berhasil menghapus data sensor');
    }
}
