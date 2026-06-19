@extends('layouts.app')
@section('title', 'Data Device')

@section('content')
<div class="page-header">
    <div class="page-header-left">
        <div class="page-breadcrumb">◫ Hardware / Device</div>
        <h1 class="page-title">Data <span>Device</span></h1>
    </div>
    <a href="{{ route('device.create') }}" class="btn btn-primary">
        + Tambah Data Device
    </a>
</div>

<div class="table-card">
    <div class="table-toolbar">
        <span class="table-meta">TOTAL: {{ $devices->total() }} RECORDS</span>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Serial Number</th>
                <th>Meta Data</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($devices as $device)
            <tr>
                <td class="td-number">{{ ($devices->currentPage() - 1) * $devices->perPage() + $loop->iteration }}</td>
                <td class="td-serial">{{ $device->serial_number }}</td>
                <td class="td-meta">{{ $device->meta_data ?? '—' }}</td>
                <td class="td-meta">{{ $device->created_at->format('d/m/Y') }}</td>
                <td>
                    <div class="td-actions">
                        <a href="{{ route('device.edit', $device) }}" class="btn btn-edit">✎ Ubah</a>
                        <button class="btn btn-delete" onclick="confirmDelete('{{ route('device.destroy', $device) }}')">✕ Hapus</button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">
                    <div class="empty-state">
                        <div class="empty-state-icon">◫</div>
                        <div class="empty-state-text">Belum ada data device</div>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($devices->hasPages())
    <div class="pagination-wrapper">
        <div class="pagination-info">
            Showing <strong>{{ $devices->firstItem() }} to {{ $devices->lastItem() }}</strong> of <strong>{{ $devices->total() }}</strong> results
        </div>
        <ul class="pagination">
            @if($devices->onFirstPage())
            <li class="disabled"><span>‹</span></li>
            @else
            <li><a href="{{ $devices->previousPageUrl() }}">‹</a></li>
            @endif

            @foreach($devices->getUrlRange(1, $devices->lastPage()) as $page => $url)
            @if($page == $devices->currentPage())
            <li class="active"><span>{{ $page }}</span></li>
            @elseif(
            $page <= 3 ||
                $page>= $devices->lastPage() - 1 ||
                abs($page - $devices->currentPage()) <= 1
                    )
                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @elseif(
                    $page == 4 && $devices->currentPage() > 4 ||
                    $page == $devices->lastPage() - 2 && $devices->currentPage() < $devices->lastPage() - 2
                        )
                        <li class="disabled"><span>…</span></li>
                        @endif
                        @endforeach

                        @if($devices->hasMorePages())
                        <li><a href="{{ $devices->nextPageUrl() }}">›</a></li>
                        @else
                        <li class="disabled"><span>›</span></li>
                        @endif
        </ul>
    </div>
    @endif
</div>
@endsection