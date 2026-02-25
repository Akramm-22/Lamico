@extends('layouts.app')

@section('content')
<h1>✏️ Edit Sensor</h1>

<form action="{{ route('sensor.update', $sensor) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="nama_sensor" value="{{ $sensor->nama_sensor }}">
    <input type="number" name="data" value="{{ $sensor->data }}">
    <button class="btn btn-primary">Update</button>
</form>
@endsection
