@extends('layouts.app')

@section('content')
<h1>➕ Tambah Sensor</h1>

<form action="{{ route('sensor.store') }}" method="POST">
    @csrf
    <input type="text" name="nama_sensor" placeholder="Nama Sensor Laut">
    <input type="number" name="data" placeholder="Nilai Data">
    <button class="btn btn-primary">Simpan</button>
</form>
@endsection
