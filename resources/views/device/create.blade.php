@extends('layouts.app')
@section('title', 'Tambah Device')

@section('content')
<div class="page-header">
    <div class="page-header-left">
        <div class="page-breadcrumb">◫ Hardware / Device / Tambah</div>
        <h1 class="page-title">Tambah <span>Device</span></h1>
    </div>
    <a href="{{ route('device.index') }}" class="btn btn-ghost">← Kembali</a>
</div>

<div class="form-card">
    <form action="{{ route('device.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="serial_number" class="form-label">Serial Number</label>
            <input type="text"
                   id="serial_number"
                   name="serial_number"
                   class="form-control {{ $errors->has('serial_number') ? 'is-invalid' : '' }}"
                   value="{{ old('serial_number') }}"
                   placeholder="Masukkan serial number...">
            @error('serial_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="meta_data" class="form-label">Meta Data <span style="color:var(--text-3)">(opsional)</span></label>
            <input type="text"
                   id="meta_data"
                   name="meta_data"
                   class="form-control {{ $errors->has('meta_data') ? 'is-invalid' : '' }}"
                   value="{{ old('meta_data') }}"
                   placeholder="Masukkan meta data...">
            @error('meta_data')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">+ Simpan Data</button>
            <a href="{{ route('device.index') }}" class="btn btn-ghost">Batal</a>
        </div>
    </form>
</div>
@endsection
