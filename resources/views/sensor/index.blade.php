@extends('layouts.app')

@section('content')
<h1>Data Sensor</h1>

@if(session('success'))
    <div class="alert">{{ session('success') }}</div>
@endif

<div class="action-bar">
    <form method="GET" class="search-input">
        <input
            type="text"
            name="search"
            value="{{ $search }}"
            placeholder="🔍 Cari nama sensor..."
        >
    </form>

    <a href="{{ route('sensor.create') }}" class="btn-add">
        <span>➕</span>
        <span>Tambah Sensor</span>
    </a>
</div>


<table>
    <tr>
        <th>Nama Sensor</th>
        <th>Data</th>
        <th>Aksi</th>
    </tr>
    @foreach($sensors as $sensor)
    <tr>
        <td>{{ $sensor->nama_sensor }}</td>
        <td>{{ $sensor->data }}</td>
        <td>
            <a href="{{ route('sensor.edit', $sensor) }}" class="btn btn-edit">Edit</a>
            <form action="{{ route('sensor.destroy', $sensor) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-delete">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
