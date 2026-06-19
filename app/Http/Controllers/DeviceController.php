<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::latest()->paginate(10);
        return view('device.index', compact('devices'));
    }

    public function create()
    {
        return view('device.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'serial_number' => 'required|string|max:255|unique:devices,serial_number',
            'meta_data'     => 'nullable|string|max:255',
        ], [
            'serial_number.required' => 'Serial number wajib diisi.',
            'serial_number.unique'   => 'Serial number sudah digunakan.',
        ]);

        Device::create($request->only('serial_number', 'meta_data'));

        return redirect()->route('device.index')
            ->with('success', 'Berhasil menambahkan data device');
    }

    public function edit(Device $device)
    {
        return view('device.edit', compact('device'));
    }

    public function update(Request $request, Device $device)
    {
        $request->validate([
            'serial_number' => 'required|string|max:255|unique:devices,serial_number,' . $device->id,
            'meta_data'     => 'nullable|string|max:255',
        ], [
            'serial_number.required' => 'Serial number wajib diisi.',
            'serial_number.unique'   => 'Serial number sudah digunakan.',
        ]);

        $device->update($request->only('serial_number', 'meta_data'));

        return redirect()->route('device.index')
            ->with('success', 'Berhasil mengubah data device');
    }

    public function destroy(Device $device)
    {
        $device->delete();

        return redirect()->route('device.index')
            ->with('success', 'Berhasil menghapus data device');
    }
}
