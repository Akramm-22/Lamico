@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="page-header">
    <div>
        <div class="page-breadcrumb">⬡ IoT / Dashboard</div>
        <h1 class="page-title">IoT <span>Monitoring Panel</span></h1>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">✓ {{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-error">✕ {{ session('error') }}</div>
@endif

{{-- ── KARTU SENSOR ── --}}
<div class="sensor-grid">

    {{-- Suhu --}}
    <div class="sensor-card">
        <div class="sensor-card-header">
            <span class="sensor-label">🌡 Suhu</span>
            <span class="badge-online">● ONLINE</span>
        </div>
        <div class="sensor-value" id="val-suhu">
            {{ $suhu?->last_value ?? '--' }}
        </div>
        <div class="sensor-unit">°C</div>
        <div class="sensor-desc">
            Sensor membaca temperatur realtime dari MQTT broker.
        </div>
        <div class="sensor-time" id="time-suhu">
            {{ $suhu?->last_updated?->diffForHumans() ?? '-' }}
        </div>
    </div>

    {{-- Kelembapan --}}
    <div class="sensor-card">
        <div class="sensor-card-header">
            <span class="sensor-label">💧 Kelembapan</span>
            <span class="badge-online">● ONLINE</span>
        </div>
        <div class="sensor-value" id="val-kelembapan">
            {{ $kelembapan?->last_value ?? '--' }}
        </div>
        <div class="sensor-unit">%</div>
        <div class="sensor-desc">
            Monitoring kelembapan ruangan berbasis sensor DHT.
        </div>
        <div class="sensor-time" id="time-kelembapan">
            {{ $kelembapan?->last_updated?->diffForHumans() ?? '-' }}
        </div>
    </div>

    {{-- Servo Control --}}
    <div class="sensor-card">
        <div class="sensor-card-header">
            <span class="sensor-label">⚙ Servo Control</span>
            <span class="badge-active">● ACTIVE</span>
        </div>
        <div class="sensor-value" id="servo-display">90</div>
        <div class="sensor-unit">°</div>
        <form action="{{ route('dashboard.servo') }}" method="POST">
            @csrf
            <input type="range"
                   name="angle"
                   id="servo-slider"
                   min="0" max="180" value="90"
                   class="slider"
                   oninput="document.getElementById('servo-display').textContent = this.value">
            <div class="slider-labels">
                <span>0°</span><span>180°</span>
            </div>
            <button type="submit" class="btn btn-primary" style="margin-top:0.75rem;width:100%">
                Kirim Servo
            </button>
        </form>
    </div>

    {{-- LCD Message --}}
    <div class="sensor-card">
        <div class="sensor-card-header">
            <span class="sensor-label">🖥 LCD Message</span>
            <span class="badge-ready">● READY</span>
        </div>
        <form action="{{ route('dashboard.lcd') }}" method="POST">
            @csrf
            <input type="text"
                   name="message"
                   class="form-control"
                   placeholder="Ketik pesan LCD..."
                   maxlength="32"
                   style="margin-bottom:0.75rem">
            <button type="submit" class="btn btn-primary" style="width:100%">
                Kirim ke LCD
            </button>
        </form>
    </div>

</div>

{{-- ── TABEL DEVICE CONNECTED ── --}}
<div style="margin-top: 2rem;">
    <div class="page-header" style="margin-bottom:1rem">
        <div>
            <h2 style="font-size:1.1rem;font-weight:700;color:#1a1d23">Device Connected</h2>
            <p style="font-size:0.82rem;color:#6b7280">
                Monitoring device yang terhubung melalui MQTT broker
            </p>
        </div>
        <span class="badge-mqtt">MQTT CONNECTED</span>
    </div>

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>Device ID</th>
                    <th>Status</th>
                    <th>Topic</th>
                    <th>Last Activity</th>
                </tr>
            </thead>
            <tbody id="device-table-body">
                @forelse($devices as $device)
                <tr>
                    <td class="td-serial">{{ $device->device_id ?? $device->serial_number }}</td>
                    <td>
                        <span class="status-badge {{ $device->status === 'online' ? 'online' : 'offline' }}">
                            {{ strtoupper($device->status) }}
                        </span>
                    </td>
                    <td class="td-meta">{{ $device->topic ?? '-' }}</td>
                    <td class="td-meta">
                        {{ $device->last_activity?->format('Y-m-d H:i:s') ?? '-' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">
                        <div class="empty-state">
                            <div class="empty-state-icon">◫</div>
                            <div class="empty-state-text">Belum ada device terhubung</div>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@push('styles')
<style>
    .sensor-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.25rem;
    }

    .sensor-card {
        background: #fff;
        border: 1px solid #e8eaef;
        border-radius: 14px;
        padding: 1.5rem;
    }

    .sensor-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        font-size: 0.85rem;
        font-weight: 600;
        color: #374151;
    }

    .sensor-value {
        font-size: 2.8rem;
        font-weight: 700;
        color: #1a1d23;
        line-height: 1;
        letter-spacing: -0.03em;
    }

    .sensor-unit {
        font-size: 0.85rem;
        color: #9ca3af;
        margin-top: 0.2rem;
        margin-bottom: 0.75rem;
    }

    .sensor-desc {
        font-size: 0.78rem;
        color: #6b7280;
        line-height: 1.5;
    }

    .sensor-time {
        font-size: 0.72rem;
        color: #9ca3af;
        margin-top: 0.5rem;
    }

    .badge-online { font-size: 0.7rem; font-weight: 600; color: #16a34a; }
    .badge-active { font-size: 0.7rem; font-weight: 600; color: #2563eb; }
    .badge-ready  { font-size: 0.7rem; font-weight: 600; color: #7c3aed; }

    .badge-mqtt {
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.06em;
        padding: 0.3rem 0.75rem;
        border-radius: 20px;
        background: #ecfdf5;
        color: #15803d;
        border: 1px solid #bbf7d0;
    }

    .status-badge {
        font-size: 0.72rem;
        font-weight: 700;
        padding: 0.25rem 0.65rem;
        border-radius: 20px;
        letter-spacing: 0.05em;
    }

    .status-badge.online  { background: #ecfdf5; color: #15803d; }
    .status-badge.offline { background: #f3f4f6; color: #9ca3af; }

    .slider {
        width: 100%;
        margin-top: 1rem;
        accent-color: #4f6ef7;
    }

    .slider-labels {
        display: flex;
        justify-content: space-between;
        font-size: 0.72rem;
        color: #9ca3af;
        margin-top: 0.25rem;
    }
</style>
@endpush

@push('scripts')
<script>
    // Auto-refresh data sensor tiap 3 detik
    function refreshSensorData() {
        fetch('/api/sensor-data')
            .then(r => r.json())
            .then(data => {
                document.getElementById('val-suhu').textContent        = data.suhu ?? '--';
                document.getElementById('val-kelembapan').textContent  = data.kelembapan ?? '--';
                document.getElementById('time-suhu').textContent       = data.suhu_time ?? '-';
                document.getElementById('time-kelembapan').textContent = data.hum_time ?? '-';

                // Update tabel device
                const tbody = document.getElementById('device-table-body');
                if (data.devices && data.devices.length > 0) {
                    tbody.innerHTML = data.devices.map(d => `
                        <tr>
                            <td style="font-weight:700;color:#4f6ef7;font-size:0.85rem">
                                ${d.device_id ?? '-'}
                            </td>
                            <td>
                                <span style="font-size:0.72rem;font-weight:700;padding:0.25rem 0.65rem;
                                border-radius:20px;letter-spacing:0.05em;
                                background:${d.status==='online'?'#ecfdf5':'#f3f4f6'};
                                color:${d.status==='online'?'#15803d':'#9ca3af'}">
                                    ${d.status?.toUpperCase() ?? 'OFFLINE'}
                                </span>
                            </td>
                            <td style="color:#6b7280;font-size:0.82rem">${d.topic ?? '-'}</td>
                            <td style="color:#6b7280;font-size:0.82rem">${d.last_activity ?? '-'}</td>
                        </tr>
                    `).join('');
                }
            })
            .catch(err => console.warn('Refresh error:', err));
    }

    setInterval(refreshSensorData, 3000);
</script>
@endpush

@endsection