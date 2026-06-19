@extends('layouts.app')
@section('title', 'Data Sensor')

@section('content')
<div class="page-header">
    <div class="page-header-left">
        <div class="page-breadcrumb">⬡ Monitoring / Sensor</div>
        <h1 class="page-title">Data <span>Sensor</span></h1>
    </div>
    <a href="{{ route('sensor.create') }}" class="btn btn-primary">
        + Tambah Data Sensor
    </a>
</div>

<div class="table-card">
    <div class="table-toolbar">
        <span class="table-meta">TOTAL: {{ $sensors->total() }} RECORDS</span>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Sensor</th>
                <th>Data</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sensors as $sensor)
            <tr>
                <td class="td-number">{{ ($sensors->currentPage() - 1) * $sensors->perPage() + $loop->iteration }}</td>
                <td class="td-sensor-name">{{ $sensor->nama_sensor }}</td>
                <td class="td-data">{{ number_format($sensor->data, 0, ',', '.') }}</td>
                <td class="td-meta">{{ $sensor->created_at->format('d/m/Y') }}</td>
                <td>
                    <div class="td-actions">
                        <a href="{{ route('sensor.edit', $sensor) }}" class="btn btn-edit">✎ Ubah</a>
                        <button class="btn btn-delete" onclick="confirmDelete('{{ route('sensor.destroy', $sensor) }}')">✕ Hapus</button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">
                    <div class="empty-state">
                        <div class="empty-state-icon">⬡</div>
                        <div class="empty-state-text">Belum ada data sensor</div>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($sensors->hasPages())
    <div class="pagination-wrapper">
        <div class="pagination-info">
            Showing <strong>{{ $sensors->firstItem() }} to {{ $sensors->lastItem() }}</strong> of <strong>{{ $sensors->total() }}</strong> results
        </div>
        <ul class="pagination">
            {{-- Previous --}}
            @if($sensors->onFirstPage())
            <li class="disabled"><span>‹</span></li>
            @else
            <li><a href="{{ $sensors->previousPageUrl() }}">‹</a></li>
            @endif

            {{-- Pages --}}
            @foreach($sensors->getUrlRange(1, $sensors->lastPage()) as $page => $url)
            @if($page == $sensors->currentPage())
            <li class="active"><span>{{ $page }}</span></li>
            @elseif(
            $page <= 3 ||
                $page>= $sensors->lastPage() - 1 ||
                abs($page - $sensors->currentPage()) <= 1
                    )
                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @elseif(
                    $page == 4 && $sensors->currentPage() > 4 ||
                    $page == $sensors->lastPage() - 2 && $sensors->currentPage() < $sensors->lastPage() - 2
                        )
                        <li class="disabled"><span>…</span></li>
                        @endif
                        @endforeach

                        {{-- Next --}}
                        @if($sensors->hasMorePages())
                        <li><a href="{{ $sensors->nextPageUrl() }}">›</a></li>
                        @else
                        <li class="disabled"><span>›</span></li>
                        @endif
        </ul>
    </div>
    @endif
</div>
@endsection