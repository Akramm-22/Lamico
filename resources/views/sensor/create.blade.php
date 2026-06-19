@extends('layouts.app')
@section('title', 'Tambah Sensor')

@section('content')
<div class="page-header">
    <div class="page-header-left">
        <div class="page-breadcrumb">⬡ Monitoring / Sensor / Tambah</div>
        <h1 class="page-title">Tambah <span>Sensor</span></h1>
    </div>
    <a href="{{ route('sensor.index') }}" class="btn btn-ghost">← Kembali</a>
</div>

<div class="form-card">
    <form action="{{ route('sensor.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nama_sensor" class="form-label">Nama Sensor</label>
            <input type="text"
                   id="nama_sensor"
                   name="nama_sensor"
                   class="form-control {{ $errors->has('nama_sensor') ? 'is-invalid' : '' }}"
                   value="{{ old('nama_sensor') }}"
                   placeholder="Masukkan nama sensor...">
            @error('nama_sensor')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="data" class="form-label">Data</label>
            <input type="number"
                   id="data"
                   name="data"
                   step="any"
                   class="form-control {{ $errors->has('data') ? 'is-invalid' : '' }}"
                   value="{{ old('data') }}"
                   placeholder="Masukkan nilai data...">
            @error('data')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">+ Simpan Data</button>
            <a href="{{ route('sensor.index') }}" class="btn btn-ghost">Batal</a>
        </div>
    </form>
</div>
@endsection
