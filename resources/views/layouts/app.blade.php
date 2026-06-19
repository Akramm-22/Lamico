<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Lamico IoT')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* RESET & BASE STYLES */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: #f8fafc; 
            color: #0f172a; 
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        .app-container { display: flex; min-height: 100vh; }

        /* SIDEBAR (Modern & Sleek) */
        .sidebar { 
            width: 260px; 
            min-width: 260px; 
            background: #ffffff; 
            border-right: 1px solid #e2e8f0; 
            display: flex; 
            flex-direction: column; 
            padding: 2rem 1.25rem; 
            position: sticky; 
            top: 0; 
            height: 100vh; 
            overflow-y: auto;
        }
        .sidebar-brand { 
            font-size: 1.15rem; 
            font-weight: 700; 
            color: #0f172a; 
            text-decoration: none; 
            padding: 0 0.75rem; 
            margin-bottom: 2.5rem; 
            display: flex;
            align-items: center;
            gap: 8px;
            letter-spacing: -0.03em;
        }
        .sidebar-brand span { 
            color: #4f6ef7; 
            background: #eef1fe;
            padding: 2px 8px;
            border-radius: 6px;
            font-size: 0.9rem;
        }
        .sidebar-label { 
            font-size: 0.65rem; 
            font-weight: 700; 
            letter-spacing: 0.15em; 
            text-transform: uppercase; 
            color: #94a3b8; 
            padding: 0 0.75rem; 
            margin-bottom: 0.75rem; 
        }
        .nav-links { list-style: none; display: flex; flex-direction: column; gap: 0.4rem; }
        .nav-links a { 
            display: flex; 
            align-items: center; 
            gap: 0.75rem; 
            padding: 0.75rem 1rem; 
            border-radius: 12px; 
            text-decoration: none; 
            font-size: 0.88rem; 
            font-weight: 500; 
            color: #64748b; 
            transition: all 0.2s ease; 
        }
        .nav-links a:hover { 
            background: #f1f5f9; 
            color: #0f172a; 
        }
        .nav-links a.active { 
            background: #4f6ef7; 
            color: #ffffff; 
            font-weight: 600; 
            box-shadow: 0 4px 12px rgba(79, 110, 247, 0.25);
        }
        .sidebar-footer { 
            margin-top: auto; 
            padding-top: 1.5rem; 
            border-top: 1px solid #f1f5f9; 
        }

        /* MAIN CONTENT AREA */
        .main-content { flex: 1; display: flex; flex-direction: column; overflow: hidden; }

        /* TOPBAR (Clean White with Subtle Shadow) */
        .topbar { 
            background: rgba(255, 255, 255, 0.8); 
            backdrop-filter: blur(8px);
            border-bottom: 1px solid #e2e8f0; 
            padding: 0 2.5rem; 
            height: 64px; 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            position: sticky; 
            top: 0; 
            z-index: 40; 
        }
        .topbar-title { font-size: 0.95rem; font-weight: 600; color: #334155; }
        .topbar-badge { 
            font-size: 0.72rem; 
            font-weight: 700; 
            padding: 0.35rem 0.75rem; 
            border-radius: 20px; 
            background: #f0fdf4; 
            color: #16a34a; 
            border: 1px solid #bbf7d0; 
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* PAGE CONTAINER */
        .page-wrapper { padding: 2.5rem; flex: 1; overflow-y: auto; }
        .page-header { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 2rem; }
        .page-breadcrumb { font-size: 0.75rem; font-weight: 500; color: #94a3b8; margin-bottom: 0.4rem; text-transform: uppercase; letter-spacing: 0.05em; }
        .page-title { font-size: 1.75rem; font-weight: 700; color: #0f172a; letter-spacing: -0.03em; }
        .page-title span { color: #4f6ef7; }

        /* ALERTS */
        .alert { padding: 1rem 1.25rem; border-radius: 12px; margin-bottom: 1.5rem; font-size: 0.88rem; font-weight: 500; display: flex; align-items: center; gap: 0.75rem; border: 1px solid transparent; }
        .alert-success { background: #f0fdf4; border-color: #bbf7d0; color: #16a34a; }
        .alert-error   { background: #fef2f2; border-color: #fecaca; color: #dc2626; }

        /* REFINED 3D BUTTONS */
        .btn { 
            display: inline-flex; 
            align-items: center; 
            justify-content: center;
            gap: 8px; 
            padding: 0.65rem 1.4rem; 
            border-radius: 12px; 
            font-family: inherit; 
            font-size: 0.88rem; 
            font-weight: 600; 
            text-decoration: none; 
            cursor: pointer; 
            border: none; 
            outline: none; 
            transition: all 0.15s ease; 
            white-space: nowrap; 
        }
        .btn-primary { background: #4f6ef7; color: #fff; box-shadow: 0 4px 0 #2e4ed4, 0 6px 10px rgba(79,110,247,0.25); }
        .btn-primary:hover  { transform: translateY(-1px); box-shadow: 0 5px 0 #2e4ed4, 0 8px 14px rgba(79,110,247,0.3); }
        .btn-primary:active { transform: translateY(3px); box-shadow: 0 1px 0 #2e4ed4, 0 2px 4px rgba(79,110,247,0.2); }
        
        .btn-edit { background: #f59e0b; color: #fff; box-shadow: 0 4px 0 #b45309, 0 6px 10px rgba(245,158,11,0.2); }
        .btn-edit:hover  { transform: translateY(-1px); box-shadow: 0 5px 0 #b45309, 0 8px 14px rgba(245,158,11,0.25); }
        .btn-edit:active { transform: translateY(3px); box-shadow: 0 1px 0 #b45309, 0 2px 4px rgba(245,158,11,0.1); }
        
        .btn-delete { background: #ef4444; color: #fff; box-shadow: 0 4px 0 #b91c1c, 0 6px 10px rgba(239,68,68,0.2); }
        .btn-delete:hover  { transform: translateY(-1px); box-shadow: 0 5px 0 #b91c1c, 0 8px 14px rgba(239,68,68,0.25); }
        .btn-delete:active { transform: translateY(3px); box-shadow: 0 1px 0 #b91c1c, 0 2px 4px rgba(239,68,68,0.1); }
        
        .btn-ghost { background: #fff; color: #475569; border: 1px solid #e2e8f0; box-shadow: 0 4px 0 #cbd5e1, 0 4px 6px rgba(0,0,0,0.02); }
        .btn-ghost:hover  { background: #f8fafc; transform: translateY(-1px); box-shadow: 0 5px 0 #cbd5e1, 0 6px 10px rgba(0,0,0,0.04); }
        .btn-ghost:active { transform: translateY(3px); box-shadow: 0 1px 0 #cbd5e1, 0 2px 4px rgba(0,0,0,0.02); }
        
        .btn-success { background: #22c55e; color: #fff; box-shadow: 0 4px 0 #15803d, 0 6px 10px rgba(34,197,94,0.2); }
        .btn-success:hover  { transform: translateY(-1px); box-shadow: 0 5px 0 #15803d, 0 8px 14px rgba(34,197,94,0.25); }
        .btn-success:active { transform: translateY(3px); box-shadow: 0 1px 0 #15803d, 0 2px 4px rgba(34,197,94,0.1); }

        /* MODERN CARD TABLES */
        .table-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02), 0 2px 4px -1px rgba(0,0,0,0.02); }
        table { width: 100%; border-collapse: collapse; }
        thead th { background: #f8fafc; font-size: 0.75rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: #64748b; padding: 1rem 1.5rem; text-align: left; border-bottom: 1px solid #e2e8f0; }
        thead th:last-child { text-align: right; }
        tbody tr { border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease; }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: #f8fafc; }
        tbody td { padding: 1.1rem 1.5rem; font-size: 0.9rem; vertical-align: middle; color: #334155; }
        .td-num    { color: #94a3b8; font-size: 0.85rem; width: 60px; }
        .td-serial { font-weight: 700; color: #4f6ef7; font-size: 0.88rem; background: #eef1fe; padding: 4px 8px; border-radius: 6px; display: inline-block;}
        .td-name   { font-weight: 600; color: #0f172a; }
        .td-data   { font-weight: 700; color: #d97706; }
        .td-meta   { color: #64748b; font-size: 0.85rem; }
        .td-actions { display: flex; gap: 0.6rem; justify-content: flex-end; }

        /* PAGINATION */
        .pagination-wrapper { display: flex; align-items: center; justify-content: space-between; padding: 1rem 1.5rem; border-top: 1px solid #f1f5f9; background: #f8fafc; }
        .pagination-info { font-size: 0.82rem; color: #64748b; }
        .pagination-info strong { color: #0f172a; font-weight: 600; }
        .pagination { display: flex; gap: 6px; list-style: none; }
        .pagination li a,
        .pagination li span { display: flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 10px; font-size: 0.82rem; font-weight: 600; text-decoration: none; border: 1px solid #e2e8f0; background: #fff; color: #475569; transition: all 0.15s ease; box-shadow: 0 2px 0 #e2e8f0; }
        .pagination li a:hover       { background: #f1f5f9; transform: translateY(-1px); box-shadow: 0 3px 0 #e2e8f0; color: #0f172a; }
        .pagination li a:active      { transform: translateY(1px); }
        .pagination li.active span   { background: #4f6ef7; border-color: #4f6ef7; color: #fff; box-shadow: 0 3px 0 #2e4ed4; }
        .pagination li.disabled span { opacity: 0.4; box-shadow: none; background: #f1f5f9; }

        /* FORM MANAGEMENT */
        .form-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 2.5rem; max-width: 560px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.01); }
        .form-group { margin-bottom: 1.5rem; }
        .form-label { display: block; font-size: 0.85rem; font-weight: 600; color: #334155; margin-bottom: 0.5rem; }
        .form-control { width: 100%; background: #fff; border: 1.5px solid #cbd5e1; border-radius: 10px; padding: 0.75rem 1rem; font-family: inherit; font-size: 0.9rem; color: #0f172a; transition: all 0.15s ease; outline: none; }
        .form-control:focus        { border-color: #4f6ef7; box-shadow: 0 0 0 4px rgba(79,110,247,0.15); }
        .form-control::placeholder { color: #94a3b8; }
        .form-control.is-invalid   { border-color: #ef4444; box-shadow: 0 0 0 4px rgba(239,68,68,0.1); }
        .invalid-feedback { font-size: 0.8rem; color: #ef4444; margin-top: 0.4rem; }
        .form-actions { display: flex; gap: 0.75rem; margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #f1f5f9; }

        /* MODAL COMFIRMATION */
        .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.3); backdrop-filter: blur(4px); z-index: 999; align-items: center; justify-content: center; }
        .modal-overlay.active { display: flex; }
        .modal-box { background: #fff; border-radius: 20px; padding: 2rem; max-width: 400px; width: 92%; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.15); animation: popIn 0.25s cubic-bezier(0.16, 1, 0.3, 1); }
        @keyframes popIn { from { opacity: 0; transform: scale(0.95) translateY(10px); } to { opacity: 1; transform: scale(1) translateY(0); } }
        .modal-title  { font-size: 1.2rem; font-weight: 700; color: #0f172a; margin-bottom: 0.75rem; letter-spacing: -0.02em; }
        .modal-body   { font-size: 0.88rem; color: #475569; line-height: 1.6; margin-bottom: 1.75rem; }
        .modal-actions { display: flex; gap: 0.75rem; justify-content: flex-end; }
    </style>
    @stack('styles')
</head>
<body>

<div class="app-container">

    {{-- SIDEBAR --}}
    <aside class="sidebar">
        <a href="{{ route('dashboard') }}" class="sidebar-brand">
            Sensor <span>ABC</span>
        </a>

        <div class="sidebar-label">Menu Utama</div>

        <ul class="nav-links">
            <li>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    📊 Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('sensor.index') }}" class="{{ request()->routeIs('sensor.*') ? 'active' : '' }}">
                    🌡 Data Sensor
                </a>
            </li>
            <li>
                <a href="{{ route('device.index') }}" class="{{ request()->routeIs('device.*') ? 'active' : '' }}">
                    ◫ Manajemen Device
                </a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <div style="font-size:0.75rem; font-weight: 600; color:#94a3b8; padding: 0 0.75rem;">
                Lamico IoT v1.0
            </div>
        </div>
    </aside>

    {{-- MAIN --}}
    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title">@yield('title', 'Dashboard')</div>
            <div>
                <span class="topbar-badge">
                    <span style="color: #22c55e; animation: pulse 2s infinite;">●</span> MQTT LIVE
                </span>
            </div>
        </div>

        <div class="page-wrapper">
            @if(session('success'))
                <div class="alert alert-success">✓ {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">✕ {{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

{{-- MODAL HAPUS --}}
<div class="modal-overlay" id="deleteModal">
    <div class="modal-box">
        <div class="modal-title">Hapus Data?</div>
        <div class="modal-body">
            Data yang dihapus akan hilang secara permanen dari sistem. Apakah Anda yakin ingin melanjutkannya?
        </div>
        <div class="modal-actions">
            <button class="btn btn-ghost" onclick="closeModal()">Batal</button>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-delete">Ya, Hapus</button>
            </form>
        </div>
    </div>
</div>

<script>
    function confirmDelete(url) {
        document.getElementById('deleteForm').action = url;
        document.getElementById('deleteModal').classList.add('active');
    }
    function closeModal() {
        document.getElementById('deleteModal').classList.remove('active');
    }
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });
</script>

@stack('scripts')
</body>
</html>