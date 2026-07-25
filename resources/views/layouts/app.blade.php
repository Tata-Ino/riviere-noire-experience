<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Rivière Noire Experience')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --c-primary: #1B5E20;
            --c-primary-light: #2E7D32;
            --c-primary-dark: #0D3B12;
            --c-secondary: #0D47A1;
            --c-secondary-light: #1565C0;
            --c-accent: #F9A825;
            --c-accent-light: #FDD835;
            --c-accent-dark: #C17900;
            --c-text: #1a1a2e;
            --c-text-light: #64748b;
            --c-text-muted: #94a3b8;
            --c-bg: #fafbfc;
            --c-bg-alt: #f1f5f9;
            --c-bg-card: #ffffff;
            --c-border: #e2e8f0;
            --c-dark: #0f172a;
            --c-dark-light: #1e293b;
            --c-white: #ffffff;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.07), 0 2px 4px -2px rgba(0,0,0,0.05);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.08), 0 4px 6px -4px rgba(0,0,0,0.04);
            --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.08), 0 8px 10px -6px rgba(0,0,0,0.04);
            --shadow-2xl: 0 25px 50px -12px rgba(0,0,0,0.15);
            --shadow-glow: 0 0 40px rgba(249,168,37,0.15);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 24px;
            --radius-2xl: 32px;
            --radius-full: 9999px;
            --ease: cubic-bezier(0.4, 0, 0.2, 1);
            --ease-bounce: cubic-bezier(0.34, 1.56, 0.64, 1);
            --font-heading: 'Playfair Display', Georgia, serif;
            --font-body: 'Inter', -apple-system, sans-serif;
        }

        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; overflow-x: hidden; }
        body {
            font-family: var(--font-body);
            color: var(--c-text);
            background: var(--c-bg);
            line-height: 1.7;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
            max-width: 100vw;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-heading);
            font-weight: 700;
            line-height: 1.2;
            color: var(--c-text);
        }
        a { text-decoration: none; transition: all 0.3s var(--ease); }

        /* Selection */
        ::selection { background: var(--c-accent); color: var(--c-dark); }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--c-bg); }
        ::-webkit-scrollbar-thumb { background: var(--c-primary-light); border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--c-primary); }

        /* ─── Buttons ─── */
        .btn {
            font-family: var(--font-body);
            font-weight: 600;
            border-radius: var(--radius-full);
            padding: 0.65rem 1.8rem;
            transition: all 0.3s var(--ease);
            position: relative;
            overflow: hidden;
        }
        .btn::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.2), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }
        .btn:hover::after { opacity: 1; }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--c-primary), var(--c-primary-light));
            color: #fff;
            border: none;
            box-shadow: 0 4px 14px rgba(27,94,32,0.3);
        }
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(27,94,32,0.35);
            color: #fff;
        }

        .btn-accent {
            background: linear-gradient(135deg, var(--c-accent), var(--c-accent-light));
            color: var(--c-dark);
            border: none;
            font-weight: 700;
            box-shadow: 0 4px 14px rgba(249,168,37,0.3);
        }
        .btn-accent:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(249,168,37,0.4);
            color: var(--c-dark);
        }

        .btn-outline-white {
            border: 2px solid rgba(255,255,255,0.5);
            color: #fff;
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(4px);
        }
        .btn-outline-white:hover {
            background: #fff;
            color: var(--c-primary);
            border-color: #fff;
            transform: translateY(-2px);
        }

        .btn-ghost {
            background: transparent;
            color: var(--c-primary);
            border: 2px solid var(--c-primary);
        }
        .btn-ghost:hover {
            background: var(--c-primary);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(27,94,32,0.25);
        }

        /* ─── Section Utilities ─── */
        .section-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1.2rem;
            border-radius: var(--radius-full);
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }
        .section-badge-green { background: rgba(27,94,32,0.08); color: var(--c-primary); }
        .section-badge-gold { background: rgba(249,168,37,0.12); color: var(--c-accent-dark); }
        .section-badge-blue { background: rgba(13,71,161,0.08); color: var(--c-secondary); }

        .section-title {
            font-family: var(--font-heading);
            font-weight: 700;
            font-size: clamp(2rem, 4vw, 3rem);
            line-height: 1.15;
        }
        .section-subtitle {
            font-size: 1.1rem;
            color: var(--c-text-light);
            line-height: 1.8;
            max-width: 600px;
        }
        .section-subtitle.mx-auto { margin-left: auto; margin-right: auto; }

        .section-divider {
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, var(--c-accent), var(--c-primary));
            border-radius: 2px;
            margin: 1rem 0;
        }
        .section-divider.mx-auto { margin-left: auto; margin-right: auto; }

        /* ─── Navbar ─── */
        .navbar-main {
            padding: 1rem 0;
            transition: all 0.4s var(--ease);
            background: transparent;
        }
        .navbar-main.scrolled {
            background: #fdfdfd;
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            box-shadow: 0 1px 0 rgba(0,0,0,0.05), var(--shadow-md);
            padding: 0.6rem 0;
        }
        .navbar-main.scrolled .navbar-brand-custom { color: var(--c-primary) !important; }
        .navbar-main.scrolled .nav-link { color: var(--c-text) !important; }
        .navbar-main.scrolled .nav-link:hover,
        .navbar-main.scrolled .nav-link.active { color: var(--c-primary) !important; }

        .navbar-main.force-scrolled {
            background: #fdfdfd !important;
            backdrop-filter: blur(20px) saturate(180%) !important;
            -webkit-backdrop-filter: blur(20px) saturate(180%) !important;
            box-shadow: 0 1px 0 rgba(0,0,0,0.05), var(--shadow-md) !important;
            padding: 0.6rem 0 !important;
        }
        .navbar-main.force-scrolled .navbar-brand-custom { color: var(--c-primary) !important; }
        .navbar-main.force-scrolled .nav-link { color: var(--c-text) !important; }
        .navbar-main.force-scrolled .nav-link:hover,
        .navbar-main.force-scrolled .nav-link.active { color: var(--c-primary) !important; }
        .navbar-main.force-scrolled .nav-icon-btn {
            border-color: rgba(0,0,0,0.15);
            background: rgba(0,0,0,0.04);
            color: var(--c-text);
        }
        .navbar-main.force-scrolled .nav-icon-btn:hover {
            background: var(--c-primary);
            color: #fff;
            border-color: var(--c-primary);
        }
        .navbar-main.force-scrolled .navbar-toggler { color: var(--c-text); }

        .navbar-brand-custom {
            font-family: var(--font-heading);
            font-weight: 800;
            font-size: 1.6rem;
            color: #fff !important;
            letter-spacing: -0.02em;
        }
        .navbar-brand-custom span { color: var(--c-accent); }

        .nav-link {
            font-weight: 500;
            padding: 0.5rem 0.9rem !important;
            color: rgba(255,255,255,0.85) !important;
            position: relative;
            font-size: 0.92rem;
            letter-spacing: 0.01em;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--c-accent);
            border-radius: 1px;
            transition: all 0.3s var(--ease);
            transform: translateX(-50%);
        }
        .nav-link:hover { color: #fff !important; }
        .nav-link:hover::after { width: 60%; }
        .nav-link.active { color: #fff !important; font-weight: 600; }
        .nav-link.active::after { width: 70%; background: var(--c-accent); }

        .navbar-main.scrolled .nav-link.active { color: var(--c-primary) !important; }
        .navbar-main.scrolled .nav-link.active::after { background: var(--c-primary); }

        .navbar-toggler {
            border: none;
            padding: 0.4rem;
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(253,253,253,0.15);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border-radius: var(--radius-full);
            transition: all 0.3s var(--ease);
            border: 1.5px solid rgba(255,255,255,0.2);
        }
        .navbar-toggler:focus { box-shadow: none; }
        .navbar-toggler:hover { background: rgba(253,253,253,0.25); transform: scale(1.05); }
        .hamburger-lines {
            width: 20px;
            height: 16px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }
        .hamburger-lines .line {
            display: block;
            width: 100%;
            height: 2.5px;
            background: #fff;
            border-radius: 2px;
            transition: all 0.3s var(--ease);
            transform-origin: center;
        }
        .navbar-main.scrolled .hamburger-lines .line,
        .navbar-main.force-scrolled .hamburger-lines .line { background: var(--c-primary); }
        .navbar-main.scrolled .navbar-toggler,
        .navbar-main.force-scrolled .navbar-toggler {
            background: rgba(27,94,32,0.08);
            border-color: rgba(27,94,32,0.15);
        }
        .navbar-menu-open .hamburger-lines .line1 {
            transform: translateY(7px) rotate(45deg);
        }
        .navbar-main.navbar-menu-open {
            backdrop-filter: none !important;
            -webkit-backdrop-filter: none !important;
        }
        .navbar-menu-open .hamburger-lines .line2 {
            opacity: 0;
            transform: scaleX(0);
        }
        .navbar-menu-open .hamburger-lines .line3 {
            transform: translateY(-7px) rotate(-45deg);
        }

        .nav-icon-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 1.5px solid rgba(255,255,255,0.3);
            background: rgba(255,255,255,0.08);
            color: rgba(255,255,255,0.9);
            font-size: 0.95rem;
            transition: all 0.3s var(--ease);
            cursor: pointer;
        }
        .nav-icon-btn:hover {
            background: var(--c-accent);
            color: var(--c-dark);
            border-color: var(--c-accent);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(249,168,37,0.3);
        }
        .navbar-main.scrolled .nav-icon-btn {
            border-color: var(--c-border);
            background: var(--c-bg);
            color: var(--c-text);
        }
        .navbar-main.scrolled .nav-icon-btn:hover {
            background: var(--c-primary);
            color: #fff;
            border-color: var(--c-primary);
        }

        .lang-dropdown-menu {
            border: none;
            box-shadow: var(--shadow-xl);
            border-radius: var(--radius-lg);
            padding: 0.5rem;
            min-width: 180px;
            animation: dropIn 0.25s var(--ease);
            border: 1px solid var(--c-border);
        }
        @keyframes dropIn {
            from { opacity: 0; transform: translateY(-8px) scale(0.97); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        .lang-dropdown-menu .dropdown-item {
            padding: 0.6rem 1rem;
            border-radius: var(--radius-sm);
            font-size: 0.9rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s var(--ease);
        }
        .lang-dropdown-menu .dropdown-item:hover {
            background: rgba(27,94,32,0.06);
            color: var(--c-primary);
        }
        .lang-dropdown-menu .dropdown-item.active {
            background: var(--c-primary);
            color: #fff;
        }

        /* ─── Cards ─── */
        .card-premium {
            background: var(--c-bg-card);
            border: 1px solid var(--c-border);
            border-radius: var(--radius-xl);
            overflow: hidden;
            transition: all 0.4s var(--ease);
            box-shadow: var(--shadow-sm);
        }
        .card-premium:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-2xl);
            border-color: transparent;
        }
        .card-premium .card-img-wrap {
            overflow: hidden;
            position: relative;
        }
        .card-premium .card-img-wrap::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.3) 0%, transparent 50%);
            opacity: 0;
            transition: opacity 0.4s var(--ease);
        }
        .card-premium:hover .card-img-wrap::after { opacity: 1; }
        .card-premium img {
            transition: transform 0.6s var(--ease);
        }
        .card-premium:hover img {
            transform: scale(1.05);
        }

        .gradient-placeholder {
            background: linear-gradient(135deg, var(--c-primary), var(--c-secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, 0.5);
            min-height: 200px;
        }
        .gradient-placeholder-sm { min-height: 160px; }

        /* ─── Footer ─── */
        .site-footer {
            background: var(--c-dark);
            color: #cbd5e1;
            padding-top: 5rem;
        }
        .site-footer h5 {
            color: #fff;
            font-family: var(--font-heading);
            font-weight: 600;
            font-size: 1.15rem;
            margin-bottom: 1.5rem;
        }
        .site-footer a { color: #94a3b8; transition: color 0.3s var(--ease); }
        .site-footer a:hover { color: var(--c-accent); }
        .site-footer ul { list-style: none; padding: 0; }
        .site-footer ul li { margin-bottom: 0.7rem; }
        .site-footer ul li a { display: flex; align-items: center; gap: 0.5rem; }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.06);
            padding: 1.5rem 0;
            margin-top: 3rem;
        }

        .social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
            color: #94a3b8;
            transition: all 0.3s var(--ease);
            font-size: 1rem;
        }
        .social-icon:hover {
            background: var(--c-accent);
            color: var(--c-dark);
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(249,168,37,0.3);
        }

        /* ─── Marquee ─── */
        .marquee-track {
            display: flex;
            width: max-content;
            animation: marquee-scroll 30s linear infinite;
        }
        .marquee-track:hover { animation-play-state: paused; }
        .marquee-content {
            display: flex;
            gap: 3rem;
            padding-right: 3rem;
        }
        .marquee-item {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            white-space: nowrap;
            font-size: 0.95rem;
        }
        .marquee-item i { font-size: 1.3rem; opacity: 0.8; }
        @keyframes marquee-scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* ─── Hero Typing ─── */
        .hero-cursor {
            display: inline-block;
            width: 3px;
            height: 0.85em;
            background: var(--c-accent);
            margin-left: 4px;
            vertical-align: text-bottom;
            animation: blink 0.75s step-end infinite;
        }
        .hero-title .line2 {
            color: var(--c-accent);
            display: inline-block;
            animation: zoomPulse 2.5s ease-in-out 1.5s infinite;
            text-shadow: 0 2px 12px rgba(0,0,0,0.5), 0 0 40px rgba(0,0,0,0.3);
        }
        @keyframes zoomPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.08); }
        }
        @keyframes blink { 50% { opacity: 0; } }

        /* ─── Scroll Animations ─── */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.8s var(--ease), transform 0.8s var(--ease);
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .reveal-left {
            opacity: 0;
            transform: translateX(-50px);
            transition: opacity 0.8s var(--ease), transform 0.8s var(--ease);
        }
        .reveal-left.visible { opacity: 1; transform: translateX(0); }
        .reveal-right {
            opacity: 0;
            transform: translateX(50px);
            transition: opacity 0.8s var(--ease), transform 0.8s var(--ease);
        }
        .reveal-right.visible { opacity: 1; transform: translateX(0); }
        .reveal-scale {
            opacity: 0;
            transform: scale(0.92);
            transition: opacity 0.8s var(--ease), transform 0.8s var(--ease);
        }
        .reveal-scale.visible { opacity: 1; transform: scale(1); }

        .stagger-1 { transition-delay: 0.1s; }
        .stagger-2 { transition-delay: 0.2s; }
        .stagger-3 { transition-delay: 0.3s; }
        .stagger-4 { transition-delay: 0.4s; }
        .stagger-5 { transition-delay: 0.5s; }

        /* ─── Responsive ─── */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: var(--c-white);
                border-radius: var(--radius-lg);
                padding: 1rem;
                margin-top: 0.5rem;
                box-shadow: var(--shadow-xl);
            }
            .navbar-main:not(.scrolled) .navbar-collapse {
                background: rgba(15,23,42,0.95);
                backdrop-filter: blur(20px);
            }
            .navbar-main:not(.scrolled) .nav-link { color: rgba(255,255,255,0.85) !important; }
            .navbar-main:not(.scrolled) .nav-link:hover,
            .navbar-main:not(.scrolled) .nav-link.active { color: #fff !important; }
            .navbar-main:not(.scrolled) .navbar-brand-custom { color: #fff !important; }
            .navbar-main:not(.scrolled) .navbar-toggler { background: rgba(255,255,255,0.12); border-color: rgba(255,255,255,0.2); }
            .navbar-main:not(.scrolled) .navbar-toggler .hamburger-lines .line { background: #fff; }
            .navbar-main.scrolled .nav-link { color: var(--c-text) !important; }
            .navbar-main.scrolled .nav-link:hover,
            .navbar-main.scrolled .nav-link.active { color: var(--c-primary) !important; }
            .navbar-main.scrolled .nav-link::after { background: var(--c-primary) !important; }
        }

        /* force-scrolled on all screen sizes (base already at line 206) */
        .navbar-main.force-scrolled .navbar-collapse { background: #fdfdfd; backdrop-filter: none; }
        .navbar-main.force-scrolled .nav-link { color: var(--c-text) !important; }
        .navbar-main.force-scrolled .nav-link:hover,
        .navbar-main.force-scrolled .nav-link.active { color: var(--c-primary) !important; }
        .navbar-main.force-scrolled .nav-link::after { background: var(--c-primary) !important; }
        .navbar-main.force-scrolled .navbar-brand-custom { color: var(--c-primary) !important; }
        .navbar-main.force-scrolled .navbar-toggler { color: var(--c-text); }

        /* ═══ Mobile Menu Animation ═══ */
        @keyframes menuSlide {
            from { transform: translateY(-100%); opacity: 0; }
            to   { transform: translateY(0);    opacity: 1; }
        }
        @keyframes menuFade {
            from { opacity: 0; }
            to   { opacity: 1; }
        }

        /* ═══ Mobile Fullscreen Menu ═══ */
        @media (max-width: 991.98px) {
            .navbar-collapse:not(.show) {
                display: none !important;
            }
            .navbar-collapse.collapsing {
                display: flex !important;
                animation: menuSlide 0.3s var(--ease) reverse both;
                transform-origin: top center;
            }
            .navbar-collapse.show {
                display: flex !important;
                flex-direction: column;
                position: fixed;
                top: 0; left: 0; right: 0;
                background: #fdfdfd !important;
                backdrop-filter: none !important;
                -webkit-backdrop-filter: none !important;
                z-index: 9999;
                margin-top: 0;
                border-radius: 0 0 var(--radius-lg) var(--radius-lg);
                box-shadow: var(--shadow-xl);
                align-items: stretch;
                justify-content: flex-start;
                padding: 1.5rem 1.5rem 2rem;
                animation: menuSlide 0.35s var(--ease) both;
                transform-origin: top center;
            }
            .navbar-collapse.show .navbar-nav {
                flex-direction: column;
                align-items: stretch;
                gap: 0;
                width: 100%;
                margin: 0 auto;
                max-width: 320px;
                padding-top: 0;
                position: relative;
                z-index: 2;
            }
            .navbar-collapse.show .menu-logo-center {
                display: flex !important;
                position: fixed;
                top: 35%;
                left: 50%;
                transform: translate(-50%, -50%);
                opacity: 0.06;
                pointer-events: none;
                z-index: 0;
            }
            .navbar-collapse.show .menu-logo-center img {
                max-height: 30vh;
                width: auto;
            }
            .navbar-collapse.show .navbar-nav .nav-item {
                width: 100%;
            }
            .navbar-collapse.show .nav-link {
                color: var(--c-text) !important;
                font-size: 0.95rem;
                font-weight: 600;
                font-family: var(--font-heading);
                padding: 0.5rem 0.8rem !important;
                border-radius: var(--radius-md);
                text-align: left;
                display: block;
                transition: all 0.2s var(--ease);
                animation: menuFade 0.4s var(--ease) both;
            }
            .navbar-collapse.show .nav-item:nth-child(1) .nav-link { animation-delay: 0.05s; }
            .navbar-collapse.show .nav-item:nth-child(2) .nav-link { animation-delay: 0.08s; }
            .navbar-collapse.show .nav-item:nth-child(3) .nav-link { animation-delay: 0.11s; }
            .navbar-collapse.show .nav-item:nth-child(4) .nav-link { animation-delay: 0.14s; }
            .navbar-collapse.show .nav-item:nth-child(5) .nav-link { animation-delay: 0.17s; }
            .navbar-collapse.show .nav-item:nth-child(6) .nav-link { animation-delay: 0.20s; }
            .navbar-collapse.show .nav-item:nth-child(7) .nav-link { animation-delay: 0.23s; }
            .navbar-collapse.show .nav-item:nth-child(8) .nav-link { animation-delay: 0.26s; }
            .navbar-collapse.show .nav-link:hover,
            .navbar-collapse.show .nav-link.active {
                background: rgba(27,94,32,0.08);
                color: var(--c-primary) !important;
            }
            .navbar-collapse.show .nav-link::after { display: none; }
            .navbar-collapse.show .d-flex {
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
                gap: 0.5rem;
                padding-top: 1rem;
                margin: 0 auto;
                border-top: 1px solid var(--c-border);
                align-items: center;
                width: 100%;
                max-width: 320px;
                animation: menuFade 0.4s var(--ease) 0.25s both;
            }
            .navbar-collapse.show .nav-icon-btn {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0.4rem;
                padding: 0.5rem 0.9rem;
                border: 1px solid var(--c-border);
                border-radius: var(--radius-full);
                text-decoration: none;
                color: var(--c-text);
                font-size: 0.85rem;
                font-weight: 500;
                transition: all 0.2s var(--ease);
            }
            .navbar-collapse.show .nav-icon-btn:hover {
                background: rgba(27,94,32,0.08);
                border-color: var(--c-primary);
                color: var(--c-primary);
            }
            .navbar-collapse.show + .mobile-menu-close,
            .navbar-menu-open .mobile-menu-close {
                display: flex !important;
                position: fixed;
                top: 1rem;
                right: 1rem;
                width: 44px;
                height: 44px;
                align-items: center;
                justify-content: center;
                border-radius: 50%;
                background: var(--c-bg-alt);
                border: none;
                font-size: 1.2rem;
                color: var(--c-text);
                z-index: 10000;
                transition: all 0.2s var(--ease);
            }
            .mobile-menu-close:hover {
                background: var(--c-primary);
                color: #fff;
            }
        }
        .menu-logo-center { display: none; }
        .mobile-menu-close { display: none; }
        @media (max-width: 767.98px) {
            .section-title { font-size: 1.8rem; }
            .btn { padding: 0.55rem 1.4rem; font-size: 0.9rem; }
        }
        @media (max-width: 575.98px) {
            .section-title { font-size: 1.5rem; }
        }
    </style>

    <style>
        @keyframes logoPulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.06); opacity: 0.85; }
        }
        @keyframes loadingBar {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- Loading Screen --}}
    <div id="loadingScreen" style="position:fixed; top:0; left:0; right:0; bottom:0; z-index:99999; background:#fdfdfd; display:flex; flex-direction:column; align-items:center; justify-content:center; transition: opacity 0.6s ease, visibility 0.6s ease;">
        <img src="{{ asset('images/LOGO2.png') }}" alt="Rivière Noire" style="height:80px; width:auto; animation: logoPulse 1.5s ease-in-out infinite;">
        <div style="margin-top:1.5rem; width:40px; height:3px; background:var(--c-bg-alt); border-radius:2px; overflow:hidden;">
            <div style="width:100%; height:100%; background:linear-gradient(90deg, var(--c-primary), var(--c-accent)); border-radius:2px; animation: loadingBar 1.2s ease-in-out infinite;"></div>
        </div>
    </div>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-main fixed-top @yield('navbar_class')" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand navbar-brand-custom d-flex align-items-center" href="{{ route('home') }}">
                <img src="{{ asset('images/LOGO2.png') }}" alt="Rivière Noire" style="height:64px; width:auto;">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-label="Menu">
                <div class="hamburger-lines">
                    <span class="line line1"></span>
                    <span class="line line2"></span>
                    <span class="line line3"></span>
                </div>
            </button>

            <button class="mobile-menu-close d-none" type="button" id="mobileMenuClose">
                <i class="bi bi-x-lg"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="menu-logo-center">
                    <img src="{{ asset('images/LOGO2.png') }}" alt="Rivière Noire">
                </div>
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            @if(App::getLocale() == 'en') Home
                            @elseif(App::getLocale() == 'pt') Início
                            @else Accueil
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about*') ? 'active' : '' }}" href="{{ route('about') }}">
                            @if(App::getLocale() == 'en') About
                            @elseif(App::getLocale() == 'pt') Sobre
                            @else À propos
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('places*') ? 'active' : '' }}" href="{{ route('places.index') }}">
                            @if(App::getLocale() == 'en') Places
                            @elseif(App::getLocale() == 'pt') Locais
                            @else Lieux
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('excursions*') ? 'active' : '' }}" href="{{ route('excursions.index') }}">
                            @if(App::getLocale() == 'en') Excursions
                            @elseif(App::getLocale() == 'pt') Excursões
                            @else Excursions
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('gallery*') ? 'active' : '' }}" href="{{ route('gallery.index') }}">
                            @if(App::getLocale() == 'en') Gallery
                            @elseif(App::getLocale() == 'pt') Galeria
                            @else Galerie
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('reservations*') ? 'active' : '' }}" href="{{ route('reservations.create') }}">
                            @if(App::getLocale() == 'en') Book
                            @elseif(App::getLocale() == 'pt') Reservar
                            @else Réserver
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                            @if(App::getLocale() == 'en') Contact
                            @elseif(App::getLocale() == 'pt') Contato
                            @else Contact
                            @endif
                        </a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-2">
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="nav-icon-btn" title="Admin">
                            <i class="bi bi-lock-fill"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="nav-icon-btn" title="Admin">
                            <i class="bi bi-lock"></i>
                        </a>
                    @endauth

                    <div class="dropdown">
                        <a class="nav-icon-btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            @if(App::getLocale() == 'en')
                                <img src="https://flagcdn.com/w20/gb.png" alt="EN" style="width:18px; height:13px; border-radius:2px; object-fit:cover;">
                            @elseif(App::getLocale() == 'pt')
                                <img src="https://flagcdn.com/w20/pt.png" alt="PT" style="width:18px; height:13px; border-radius:2px; object-fit:cover;">
                            @else
                                <img src="https://flagcdn.com/w20/fr.png" alt="FR" style="width:18px; height:13px; border-radius:2px; object-fit:cover;">
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end lang-dropdown-menu">
                            <li><a class="dropdown-item {{ App::getLocale() == 'fr' ? 'active' : '' }}" href="{{ route('language.switch', 'fr') }}"><img src="https://flagcdn.com/w20/fr.png" alt="FR" style="width:20px; height:15px; border-radius:2px; object-fit:cover;"> Français</a></li>
                            <li><a class="dropdown-item {{ App::getLocale() == 'en' ? 'active' : '' }}" href="{{ route('language.switch', 'en') }}"><img src="https://flagcdn.com/w20/gb.png" alt="EN" style="width:20px; height:15px; border-radius:2px; object-fit:cover;"> English</a></li>
                            <li><a class="dropdown-item {{ App::getLocale() == 'pt' ? 'active' : '' }}" href="{{ route('language.switch', 'pt') }}"><img src="https://flagcdn.com/w20/pt.png" alt="PT" style="width:20px; height:15px; border-radius:2px; object-fit:cover;"> Português</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main style="overflow-x: hidden;">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="site-footer">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('home') }}" class="d-inline-block mb-4" style="font-family: var(--font-heading); font-weight: 800; font-size: 1.5rem; color: #fff;">
                        Rivière <span style="color: var(--c-accent);">Noire</span>
                    </a>
                    <p style="line-height: 1.8; font-size: 0.95rem;">
                        @if(App::getLocale() == 'en')
                            Discover the natural beauty and cultural richness of the Black River in Adjarra, Benin.
                        @elseif(App::getLocale() == 'pt')
                            Descubra a beleza natural e a riqueza cultural do Rio Negro em Adjarra, Benin.
                        @else
                            Découvrez la beauté naturelle et la richesse culturelle de la Rivière Noire d'Adjarra au Bénin.
                        @endif
                    </p>
                    <div class="d-flex gap-2 mt-4">
                        <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-youtube"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-tiktok"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h5>@if(App::getLocale() == 'en') Quick Links @elseif(App::getLocale() == 'pt') Links Rápidos @else Liens rapides @endif</h5>
                    <ul>
                        <li><a href="{{ route('home') }}"><i class="bi bi-chevron-right" style="font-size:0.7rem;"></i> @if(App::getLocale() == 'en') Home @elseif(App::getLocale() == 'pt') Início @else Accueil @endif</a></li>
                        <li><a href="{{ route('about') }}"><i class="bi bi-chevron-right" style="font-size:0.7rem;"></i> @if(App::getLocale() == 'en') About @elseif(App::getLocale() == 'pt') Sobre @else À propos @endif</a></li>
                        <li><a href="{{ route('places.index') }}"><i class="bi bi-chevron-right" style="font-size:0.7rem;"></i> @if(App::getLocale() == 'en') Destinations @elseif(App::getLocale() == 'pt') Destinos @else Destinations @endif</a></li>
                        <li><a href="{{ route('excursions.index') }}"><i class="bi bi-chevron-right" style="font-size:0.7rem;"></i> @if(App::getLocale() == 'en') Excursions @elseif(App::getLocale() == 'pt') Excursões @else Excursions @endif</a></li>
                        <li><a href="{{ route('gallery.index') }}"><i class="bi bi-chevron-right" style="font-size:0.7rem;"></i> @if(App::getLocale() == 'en') Gallery @elseif(App::getLocale() == 'pt') Galeria @else Galerie @endif</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5>@if(App::getLocale() == 'en') Explore @elseif(App::getLocale() == 'pt') Explorar @else Explorer @endif</h5>
                    <ul>
                        <li><a href="{{ route('reservations.create') }}"><i class="bi bi-chevron-right" style="font-size:0.7rem;"></i> @if(App::getLocale() == 'en') Book Now @elseif(App::getLocale() == 'pt') Reservar @else Réserver @endif</a></li>
                        <li><a href="{{ route('contact') }}"><i class="bi bi-chevron-right" style="font-size:0.7rem;"></i> @if(App::getLocale() == 'en') Contact @elseif(App::getLocale() == 'pt') Contato @else Contact @endif</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5>@if(App::getLocale() == 'en') Contact @elseif(App::getLocale() == 'pt') Contato @else Contact @endif</h5>
                    <ul>
                        <li class="mb-3" style="display:flex; align-items:center; white-space:nowrap;"><i class="bi bi-geo-alt-fill me-2" style="color: var(--c-accent);"></i> Adjarra, Ouémé, Bénin</li>
                        <li class="mb-3" style="display:flex; align-items:center; white-space:nowrap;"><i class="bi bi-telephone-fill me-2" style="color: var(--c-accent);"></i> <a href="tel:+22996516760">+229 96 51 67 60</a></li>
                        <li class="mb-3" style="display:flex; align-items:center; white-space:nowrap;"><i class="bi bi-envelope-fill me-2" style="color: var(--c-accent);"></i> <a href="mailto:info@rivierenoire.bj">info@rivierenoire.bj</a></li>
                        <li class="mb-3" style="display:flex; align-items:center; white-space:nowrap;"><i class="bi bi-whatsapp me-2" style="color: var(--c-accent);"></i> <a href="https://wa.me/22996516760" target="_blank">WhatsApp</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom text-center">
                <p class="mb-1 small" style="color: #64748b;">
                    &copy; {{ date('Y') }} Rivière Noire Experience. All rights reserved.
                </p>
                <p class="mb-0 small" style="color: #475569;">
                    Développé par <a href="https://wa.me/22954253797" target="_blank" style="color: var(--c-accent); font-weight:600; text-decoration:none; transition: color 0.3s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='var(--c-accent)'"><i class="bi bi-heart-fill" style="font-size:0.7rem;"></i> Inès GANDAHO</a>
                </p>
            </div>
        </div>
    </footer>

    {{-- WhatsApp --}}
    <a href="https://wa.me/22996516760" target="_blank" rel="noopener" id="whatsappFloat" style="position:fixed; bottom:28px; right:24px; z-index:9999; width:56px; height:56px; border-radius:50%; background:linear-gradient(135deg,#25D366,#128C7E); color:#fff; display:flex; align-items:center; justify-content:center; font-size:1.6rem; box-shadow:0 4px 20px rgba(37,211,102,0.35); transition:all 0.3s var(--ease);">
        <i class="bi bi-whatsapp"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Hide loading screen
        window.addEventListener('load', function() {
            var loader = document.getElementById('loadingScreen');
            if (loader) {
                setTimeout(function() {
                    loader.style.opacity = '0';
                    loader.style.visibility = 'hidden';
                    setTimeout(function() { loader.remove(); }, 600);
                }, 800);
            }
        });
    </script>

    <script>
        // Navbar scroll
        (function() {
            var navbar = document.getElementById('mainNavbar');
            if (!navbar) return;
            var forceScrolled = navbar.classList.contains('force-scrolled');
            function update() {
                if (forceScrolled) { navbar.classList.add('scrolled'); return; }
                navbar.classList.toggle('scrolled', window.scrollY > 60);
            }
            window.addEventListener('scroll', update, { passive: true });
            update();
        })();

        // Mobile menu toggle
        (function() {
            var navbar = document.getElementById('mainNavbar');
            var collapseEl = document.getElementById('navbarNav');
            if (!navbar || !collapseEl) return;
            collapseEl.addEventListener('show.bs.collapse', function() {
                navbar.classList.add('navbar-menu-open');
            });
            collapseEl.addEventListener('hide.bs.collapse', function() {
                navbar.classList.remove('navbar-menu-open');
            });
            // Close menu when clicking a nav link
            navbar.querySelectorAll('.nav-link').forEach(function(link) {
                link.addEventListener('click', function() {
                    var bsCollapse = bootstrap.Collapse.getInstance(collapseEl);
                    if (bsCollapse) bsCollapse.hide();
                });
            });
        })();

        // Mobile close button
        (function() {
            var closeBtn = document.getElementById('mobileMenuClose');
            var collapseEl = document.getElementById('navbarNav');
            if (!closeBtn || !collapseEl) return;
            closeBtn.addEventListener('click', function() {
                var bsCollapse = bootstrap.Collapse.getInstance(collapseEl);
                if (bsCollapse) bsCollapse.hide();
            });
        })();

        // WhatsApp pulse
        (function() {
            var wa = document.getElementById('whatsappFloat');
            if (!wa) return;
            wa.addEventListener('mouseenter', function() { this.style.transform = 'scale(1.1)'; });
            wa.addEventListener('mouseleave', function() { this.style.transform = 'scale(1)'; });
        })();

        // Scroll reveal
        (function() {
            if (!('IntersectionObserver' in window)) {
                document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale').forEach(function(el) {
                    el.classList.add('visible');
                });
                return;
            }
            var observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
            document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale').forEach(function(el) {
                observer.observe(el);
            });
        })();
    </script>

    {{-- Hero typing --}}
    <script>
    (function () {
        var el = document.getElementById('heroTitle');
        if (!el) return;
        var line1 = el.getAttribute('data-line1') || '';
        var line2 = el.getAttribute('data-line2') || '';
        var speed = 80;
        var i = 0;
        var html = '';

        function type(text, cb) {
            if (i < text.length) {
                html += text[i];
                el.innerHTML = html + '<span class="hero-cursor"></span>';
                i++;
                setTimeout(type, speed, text, cb);
            } else {
                cb();
            }
        }

        type(line1, function () {
            setTimeout(function () {
                html += '<br><span class="line2">';
                el.innerHTML = html + '<span class="hero-cursor"></span>';
                i = 0;
                type(line2, function () {
                    el.innerHTML = html + '</span>';
                });
            }, 400);
        });

        setTimeout(function () {
            var desc = document.getElementById('heroDesc');
            var btns = document.getElementById('heroButtons');
            if (desc) { desc.style.transition = 'opacity 0.8s ease'; desc.style.opacity = '1'; }
            if (btns) { btns.style.transition = 'opacity 0.8s ease 0.3s'; btns.style.opacity = '1'; }
        }, 1200);
    })();
    </script>

    @stack('scripts')
</body>
</html>
