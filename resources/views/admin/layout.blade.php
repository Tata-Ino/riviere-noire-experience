<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - RNE Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --vert-foret: #2E7D32;
            --vert-clair: #4CAF50;
            --bleu-profond: #1565C0;
            --dore: #F9A825;
            --dore-light: #FDD835;
            --sidebar-w: 260px;
            --topbar-h: 68px;
            --admin-bg: #f8fafb;
            --admin-card: #ffffff;
            --admin-text: #0f172a;
            --admin-muted: #64748b;
            --admin-border: #e2e8f0;
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: var(--admin-bg);
            color: var(--admin-text);
            margin: 0;
            -webkit-font-smoothing: antialiased;
        }

        /* ─── Sidebar ─── */
        .sidebar {
            position: fixed; top: 0; left: 0; bottom: 0;
            width: var(--sidebar-w);
            background: linear-gradient(180deg, #0c1222 0%, #131c31 50%, #0f172a 100%);
            color: #e2e8f0;
            z-index: 1040;
            overflow-y: auto;
            transition: transform 0.3s cubic-bezier(0.4,0,0.2,1);
            display: flex;
            flex-direction: column;
            border-right: 1px solid rgba(255,255,255,0.04);
        }
        .sidebar-brand {
            padding: 1.25rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            text-decoration: none;
            color: #fff;
            transition: background 0.2s;
        }
        .sidebar-brand:hover { background: rgba(255,255,255,0.03); }
        .sidebar-brand .brand-icon {
            width: 40px; height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--vert-foret), var(--vert-clair));
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; color: #fff;
            box-shadow: 0 4px 12px rgba(46,125,50,0.3);
            flex-shrink: 0;
        }
        .sidebar-brand .brand-text {
            font-family: 'Playfair Display', serif;
            font-weight: 800; font-size: 1.15rem;
        }
        .sidebar-brand .brand-text span { color: var(--dore); }

        .sidebar-nav {
            padding: 0.75rem 0;
            flex: 1;
        }
        .sidebar-nav .nav-section {
            padding: 0.75rem 1.25rem 0.35rem;
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #475569;
            font-weight: 700;
        }
        .sidebar-nav .nav-link {
            color: #94a3b8;
            padding: 0.65rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.85rem;
            font-weight: 500;
            border-left: 3px solid transparent;
            transition: all 0.2s ease;
            text-decoration: none;
            margin: 2px 0.5rem;
            border-radius: 0 10px 10px 0;
            position: relative;
        }
        .sidebar-nav .nav-link:hover {
            color: #fff;
            background: rgba(255,255,255,0.05);
        }
        .sidebar-nav .nav-link.active {
            color: #fff;
            background: linear-gradient(90deg, rgba(46,125,50,0.15), rgba(46,125,50,0.05));
            border-left-color: var(--dore);
        }
        .sidebar-nav .nav-link.active i {
            color: var(--dore);
        }
        .sidebar-nav .nav-link i {
            font-size: 1.1rem;
            width: 22px;
            text-align: center;
            flex-shrink: 0;
            transition: color 0.2s;
        }
        .sidebar-nav .nav-badge {
            margin-left: auto;
            background: linear-gradient(135deg, var(--dore), var(--dore-light));
            color: #000;
            font-size: 0.65rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(249,168,37,0.3);
        }

        .sidebar-footer {
            border-top: 1px solid rgba(255,255,255,0.05);
            padding: 0.75rem 1rem;
        }
        .sidebar-footer .nav-link {
            color: #ef4444;
            padding: 0.65rem 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.85rem;
            font-weight: 500;
            border: none;
            background: none;
            cursor: pointer;
            width: 100%;
            border-radius: 10px;
            transition: all 0.2s;
        }
        .sidebar-footer .nav-link:hover { background: rgba(239,68,68,0.1); }

        /* ─── Topbar ─── */
        .topbar {
            position: fixed;
            top: 0; left: var(--sidebar-w); right: 0;
            height: var(--topbar-h);
            background: rgba(255,255,255,0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0,0,0,0.04);
            z-index: 1030;
            display: flex;
            align-items: center;
            padding: 0 1.75rem;
        }
        .topbar .sidebar-toggle {
            display: none;
            cursor: pointer;
            font-size: 1.5rem;
            color: var(--admin-text);
            border: none;
            background: none;
            padding: 0.25rem;
            transition: color 0.2s;
        }
        .topbar .sidebar-toggle:hover { color: var(--vert-foret); }
        .topbar .page-title {
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--admin-text);
            letter-spacing: -0.02em;
        }
        .topbar .ms-auto .dropdown-toggle {
            color: var(--admin-text);
            font-weight: 600;
            font-size: 0.88rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.4rem 0.75rem;
            border-radius: 12px;
            transition: background 0.2s;
        }
        .topbar .ms-auto .dropdown-toggle:hover {
            background: rgba(0,0,0,0.04);
        }
        .topbar .user-avatar {
            width: 36px; height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--vert-foret), var(--bleu-profond));
            color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700;
            font-size: 0.85rem;
            box-shadow: 0 2px 8px rgba(46,125,50,0.25);
        }

        /* ─── Main ─── */
        .main-content {
            margin-left: var(--sidebar-w);
            padding: calc(var(--topbar-h) + 1.75rem) 1.75rem 1.75rem;
            min-height: 100vh;
        }

        /* ─── Cards ─── */
        .stat-card {
            border: none;
            border-radius: 18px;
            background: var(--admin-card);
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
            border: 1px solid rgba(0,0,0,0.04);
        }
        .stat-card:hover {
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            transform: translateY(-2px);
        }
        .stat-card .stat-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
        }
        .stat-card .stat-value {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--admin-text);
            letter-spacing: -0.03em;
        }
        .stat-card .stat-label {
            font-size: 0.78rem;
            color: var(--admin-muted);
            font-weight: 500;
        }

        .card {
            border: none;
            border-radius: 18px;
            background: var(--admin-card);
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            border: 1px solid rgba(0,0,0,0.04);
            transition: box-shadow 0.3s;
        }
        .card:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.06); }
        .card-header {
            background: transparent;
            border-bottom: 1px solid var(--admin-border);
            padding: 1rem 1.25rem;
        }
        .card-header h6, .card-title {
            font-weight: 700;
            letter-spacing: -0.01em;
        }

        /* ─── Table ─── */
        .table th {
            font-weight: 700;
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--admin-muted);
            border-bottom: 1px solid var(--admin-border);
            padding: 0.75rem;
        }
        .table td {
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
            padding: 0.75rem;
        }
        .table tbody tr {
            transition: background 0.15s;
        }
        .table tbody tr:hover { background: #f8fafc; }

        .badge-status {
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.02em;
        }

        /* ─── Buttons ─── */
        .btn {
            font-weight: 600;
            font-size: 0.85rem;
            border-radius: 10px;
            transition: all 0.2s ease;
        }
        .btn:hover { transform: translateY(-1px); }
        .btn:active { transform: translateY(0); }
        .btn-primary {
            background: linear-gradient(135deg, var(--vert-foret), var(--vert-clair));
            border: none;
            box-shadow: 0 2px 8px rgba(46,125,50,0.2);
        }
        .btn-primary:hover {
            box-shadow: 0 4px 16px rgba(46,125,50,0.3);
            background: linear-gradient(135deg, #1B5E20, var(--vert-foret));
        }
        .btn-outline-primary {
            border-color: var(--admin-border);
            color: var(--admin-text);
        }
        .btn-outline-primary:hover {
            background: var(--admin-text);
            border-color: var(--admin-text);
            color: #fff;
        }
        .btn-outline-secondary {
            border-color: var(--admin-border);
            color: var(--admin-muted);
        }
        .btn-outline-secondary:hover {
            background: var(--admin-muted);
            border-color: var(--admin-muted);
            color: #fff;
        }

        /* ─── Form controls ─── */
        .form-control, .form-select {
            border-radius: 10px;
            border: 1.5px solid var(--admin-border);
            padding: 0.6rem 0.9rem;
            font-size: 0.88rem;
            transition: all 0.2s;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--vert-clair);
            box-shadow: 0 0 0 3px rgba(76,175,80,0.1);
        }
        .form-label {
            font-weight: 600;
            font-size: 0.8rem;
            color: var(--admin-muted);
            margin-bottom: 0.35rem;
        }

        /* ─── Bottom navbar (mobile only) ─── */
        .bottom-nav {
            display: none;
            position: fixed;
            bottom: 0; left: 0; right: 0;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-top: 1px solid rgba(0,0,0,0.06);
            z-index: 1050;
            padding: 0.3rem 0 env(safe-area-inset-bottom, 0.4rem);
        }
        .bottom-nav .nav {
            justify-content: space-around;
            max-width: 500px;
            margin: 0 auto;
        }
        .bottom-nav .nav-link {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.2rem;
            padding: 0.5rem 0.4rem;
            color: var(--admin-muted);
            font-size: 0.62rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            border-radius: 12px;
            min-width: 0;
            flex: 1;
            position: relative;
        }
        .bottom-nav .nav-link i {
            font-size: 1.3rem;
            transition: transform 0.2s;
        }
        .bottom-nav .nav-link.active {
            color: var(--vert-foret);
        }
        .bottom-nav .nav-link.active i {
            transform: scale(1.1);
        }
        .bottom-nav .nav-link.active::before {
            content: '';
            position: absolute;
            top: -0.3rem;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 3px;
            border-radius: 2px;
            background: linear-gradient(90deg, var(--vert-foret), var(--vert-clair));
        }
        .bottom-nav .nav-link:hover { color: var(--vert-foret); }

        /* ─── Backdrop ─── */
        .sidebar-backdrop {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.6);
            backdrop-filter: blur(4px);
            z-index: 1035;
        }
        .sidebar-backdrop.show { display: block; }

        /* ─── Responsive ─── */
        @media (max-width: 991.98px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .topbar { left: 0; }
            .topbar .sidebar-toggle { display: block; }
            .main-content { margin-left: 0; }
            .bottom-nav { display: block; }
            .main-content { padding-bottom: 5rem; }
        }
        @media (max-width: 575.98px) {
            .main-content { padding: calc(var(--topbar-h) + 1rem) 1rem 1rem; }
        }

        /* Scrollbar */
        .sidebar::-webkit-scrollbar { width: 4px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.08); border-radius: 4px; }

        /* ─── Animations ─── */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .main-content > * {
            animation: fadeIn 0.4s ease-out;
        }

        /* ─── Nav tabs premium ─── */
        .nav-tabs .nav-link {
            border: none;
            color: var(--admin-muted);
            font-weight: 600;
            font-size: 0.82rem;
            padding: 0.6rem 1rem;
            border-radius: 8px 8px 0 0;
            transition: all 0.2s;
        }
        .nav-tabs .nav-link.active {
            color: var(--vert-foret);
            background: rgba(46,125,50,0.06);
            border-bottom: 2px solid var(--vert-foret);
        }
    </style>
    @stack('styles')
</head>
<body>

{{-- ═══ Sidebar ═══ --}}
<aside class="sidebar" id="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
        <div class="brand-icon"><img src="{{ asset('images/LOGO2.png') }}" alt="Rivière Noire" style="width:36px; height:36px; border-radius:8px;"></div>
        <div class="brand-text">Rivière <span>Noire</span></div>
    </a>
    <nav class="sidebar-nav">
        <div class="nav-section">Principal</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-grid-1x2"></i> Dashboard
                </a>
            </li>
        </ul>
        <div class="nav-section mt-3">Gestion</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.places.*') ? 'active' : '' }}" href="{{ route('admin.places.index') }}">
                    <i class="bi bi-geo-alt"></i> Lieux
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.excursions.*') ? 'active' : '' }}" href="{{ route('admin.excursions.index') }}">
                    <i class="bi bi-compass"></i> Excursions
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.restaurant.*') ? 'active' : '' }}" href="{{ route('admin.restaurant.index') }}">
                    <i class="bi bi-cup-hot"></i> Restaurant
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.reservations.*') ? 'active' : '' }}" href="{{ route('admin.reservations.index') }}">
                    <i class="bi bi-calendar-check"></i> Réservations
                </a>
            </li>
        </ul>
        <div class="nav-section mt-3">Engagement</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}" href="{{ route('admin.testimonials.index') }}">
                    <i class="bi bi-chat-quote"></i> Témoignages
                    @php
                        $pendingCount = \App\Models\Testimonial::where('is_published', false)->count();
                    @endphp
                    @if($pendingCount > 0)
                        <span class="nav-badge">{{ $pendingCount }}</span>
                    @endif
                </a>
            </li>
        </ul>
        <div class="nav-section mt-3">Système</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.contact') }}">
                    <i class="bi bi-gear"></i> Paramètres
                </a>
            </li>
        </ul>
    </nav>
    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link">
                <i class="bi bi-box-arrow-left"></i> Déconnexion
            </button>
        </form>
    </div>
</aside>

<div class="sidebar-backdrop" id="sidebarBackdrop"></div>

{{-- ═══ Topbar ═══ --}}
<header class="topbar">
    <button class="sidebar-toggle me-3" id="sidebarToggle">
        <i class="bi bi-list"></i>
    </button>
    <span class="page-title d-none d-md-inline">@yield('page-title', '')</span>
    <div class="ms-auto dropdown">
        <a class="dropdown-toggle text-decoration-none d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
            <div class="user-avatar d-none d-sm-flex">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</div>
            <span class="d-none d-sm-inline">{{ Auth::user()->name ?? 'Admin' }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" style="border-radius:14px; box-shadow:0 12px 40px rgba(0,0,0,0.12); border:1px solid rgba(0,0,0,0.04); padding:0.5rem;">
            <li><span class="dropdown-item-text fw-semibold" style="font-size:0.85rem; padding:0.5rem 0.75rem;">{{ Auth::user()->email ?? '' }}</span></li>
            <li><hr class="dropdown-divider" style="margin:0.25rem 0;"></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger" style="font-size:0.85rem; border-radius:8px; padding:0.5rem 0.75rem;">
                        <i class="bi bi-box-arrow-left me-2"></i>Déconnexion
                    </button>
                </form>
            </li>
        </ul>
    </div>
</header>

{{-- ═══ Main Content ═══ --}}
<main class="main-content">
@if(session('success'))
    <div id="flash-success" data-message="{{ session('success') }}" style="display:none;"></div>
@endif
@if(session('error'))
    <div id="flash-error" data-message="{{ session('error') }}" style="display:none;"></div>
@endif
    @yield('content')
</main>

{{-- ═══ Bottom Nav (Mobile) ═══ --}}
<nav class="bottom-nav" id="bottomNav">
    <div class="nav">
        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-grid-1x2"></i>
            <span>Accueil</span>
        </a>
        <a class="nav-link {{ request()->routeIs('admin.places.*') ? 'active' : '' }}" href="{{ route('admin.places.index') }}">
            <i class="bi bi-geo-alt"></i>
            <span>Lieux</span>
        </a>
        <a class="nav-link {{ request()->routeIs('admin.reservations.*') ? 'active' : '' }}" href="{{ route('admin.reservations.index') }}">
            <i class="bi bi-calendar-check"></i>
            <span>Résas</span>
        </a>
        <a class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}" href="{{ route('admin.testimonials.index') }}">
            <i class="bi bi-chat-quote"></i>
            <span>Avis</span>
        </a>
        <a class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.contact') }}">
            <i class="bi bi-gear"></i>
            <span>Param.</span>
        </a>
    </div>
</nav>

<div class="modal fade" id="flashModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border:none; border-radius:18px; overflow:hidden; box-shadow:0 20px 60px rgba(0,0,0,0.15);">
            <div class="modal-body text-center p-5">
                <div id="flashModalIcon" class="mb-3"></div>
                <h5 id="flashModalTitle" class="fw-bold mb-2" style="font-size:1.2rem;"></h5>
                <p id="flashModalMessage" class="mb-0" style="font-size:0.95rem; color:#555;"></p>
            </div>
            <div class="px-4 pb-4">
                <div class="progress" style="height:6px; border-radius:10px; background:#e9ecef;">
                    <div id="flashModalProgress" class="progress-bar" role="progressbar" style="width:100%; border-radius:10px; transition:width 0.1s linear;"></div>
                </div>
                <small id="flashModalTimer" class="text-muted d-block mt-2" style="font-size:0.8rem;"></small>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    const backdrop = document.getElementById('sidebarBackdrop');

    sidebarToggle.addEventListener('click', () => {
        sidebar.classList.toggle('show');
        backdrop.classList.toggle('show');
    });
    backdrop.addEventListener('click', () => {
        sidebar.classList.remove('show');
        backdrop.classList.remove('show');
    });

    (function() {
        var successEl = document.getElementById('flash-success');
        var errorEl = document.getElementById('flash-error');
        if (!successEl && !errorEl) return;

        var isError = !!errorEl;
        var message = isError ? errorEl.dataset.message : successEl.dataset.message;
        var modal = new bootstrap.Modal(document.getElementById('flashModal'));

        var iconEl = document.getElementById('flashModalIcon');
        var titleEl = document.getElementById('flashModalTitle');
        var msgEl = document.getElementById('flashModalMessage');
        var progressEl = document.getElementById('flashModalProgress');
        var timerEl = document.getElementById('flashModalTimer');

        if (isError) {
            iconEl.innerHTML = '<div style="width:64px;height:64px;border-radius:50%;background:rgba(239,68,68,0.1);display:inline-flex;align-items:center;justify-content:center;"><i class="bi bi-exclamation-triangle-fill" style="font-size:2rem;color:#dc2626;"></i></div>';
            titleEl.textContent = 'Erreur';
            titleEl.style.color = '#dc2626';
            progressEl.style.background = '#dc2626';
        } else {
            iconEl.innerHTML = '<div style="width:64px;height:64px;border-radius:50%;background:rgba(46,125,50,0.1);display:inline-flex;align-items:center;justify-content:center;"><i class="bi bi-check-circle-fill" style="font-size:2rem;color:var(--vert-foret);"></i></div>';
            titleEl.textContent = 'Succès';
            titleEl.style.color = 'var(--vert-foret)';
            progressEl.style.background = 'var(--vert-foret)';
        }

        msgEl.textContent = message;
        modal.show();

        var duration = 5000;
        var start = Date.now();
        var remaining = duration;

        function tick() {
            remaining = duration - (Date.now() - start);
            if (remaining <= 0) {
                modal.hide();
                return;
            }
            var pct = (remaining / duration) * 100;
            progressEl.style.width = pct + '%';
            timerEl.textContent = (remaining / 1000).toFixed(1) + 's';
            requestAnimationFrame(tick);
        }
        tick();
    })();
</script>
@stack('scripts')
</body>
</html>
