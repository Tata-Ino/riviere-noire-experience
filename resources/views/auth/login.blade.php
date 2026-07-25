<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Connexion - Rivière Noire Experience</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --vert-foret: #2E7D32;
            --vert-clair: #4CAF50;
            --bleu-profond: #1565C0;
            --dore: #F9A825;
            --dore-light: #FDD835;
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', -apple-system, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0f172a;
            overflow: hidden;
            position: relative;
        }
        body::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 50% at 20% 40%, rgba(46,125,50,0.15) 0%, transparent 60%),
                radial-gradient(ellipse 60% 40% at 80% 60%, rgba(249,168,37,0.08) 0%, transparent 50%),
                radial-gradient(ellipse 50% 50% at 50% 50%, rgba(21,101,192,0.06) 0%, transparent 60%);
            pointer-events: none;
        }
        .login-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 440px;
            padding: 1.5rem;
        }
        .login-card {
            background: rgba(255,255,255,0.03);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 80px rgba(0,0,0,0.4), 0 0 0 1px rgba(255,255,255,0.05) inset;
        }
        .login-header {
            padding: 2.5rem 2rem 2rem;
            text-align: center;
            position: relative;
        }
        .login-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 2rem;
            right: 2rem;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
        }
        .brand-logo {
            width: 64px;
            height: 64px;
            border-radius: 18px;
            background: linear-gradient(135deg, var(--vert-foret), var(--vert-clair));
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.25rem;
            box-shadow: 0 8px 32px rgba(46,125,50,0.3);
            position: relative;
        }
        .brand-logo::after {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--vert-clair), var(--dore));
            z-index: -1;
            opacity: 0.4;
        }
        .brand-logo img {
            width: 42px;
            height: 42px;
            border-radius: 10px;
        }
        .brand-title {
            font-family: 'Playfair Display', serif;
            font-weight: 800;
            font-size: 1.6rem;
            color: #fff;
            margin-bottom: 0.3rem;
            letter-spacing: -0.02em;
        }
        .brand-title span { color: var(--dore); }
        .brand-subtitle {
            color: rgba(255,255,255,0.45);
            font-size: 0.82rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.12em;
        }
        .login-body {
            padding: 2rem;
        }
        .form-floating-custom {
            position: relative;
            margin-bottom: 1.25rem;
        }
        .form-floating-custom label {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.35);
            font-size: 0.85rem;
            font-weight: 500;
            pointer-events: none;
            transition: all 0.2s ease;
            z-index: 2;
        }
        .form-floating-custom input:focus + label,
        .form-floating-custom input:not(:placeholder-shown) + label {
            top: -0.5rem;
            left: 0.75rem;
            font-size: 0.7rem;
            color: var(--vert-clair);
            background: #1e293b;
            padding: 0 0.4rem;
        }
        .form-floating-custom .input-icon {
            position: absolute;
            top: 50%;
            right: 1rem;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.25);
            font-size: 1rem;
            z-index: 2;
            transition: color 0.2s;
        }
        .form-floating-custom input:focus ~ .input-icon {
            color: var(--vert-clair);
        }
        .form-floating-custom input {
            width: 100%;
            padding: 1rem 2.8rem 0.5rem 1rem;
            background: rgba(255,255,255,0.04);
            border: 1.5px solid rgba(255,255,255,0.08);
            border-radius: 14px;
            color: #fff;
            font-size: 0.92rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.25s ease;
            outline: none;
        }
        .form-floating-custom input::placeholder {
            color: transparent;
        }
        .form-floating-custom input:focus {
            border-color: var(--vert-clair);
            background: rgba(46,125,50,0.06);
            box-shadow: 0 0 0 3px rgba(46,125,50,0.12), 0 0 20px rgba(46,125,50,0.08);
        }
        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.75rem;
        }
        .remember-check {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }
        .remember-check input[type="checkbox"] {
            appearance: none;
            -webkit-appearance: none;
            width: 18px;
            height: 18px;
            border: 1.5px solid rgba(255,255,255,0.15);
            border-radius: 5px;
            background: rgba(255,255,255,0.04);
            cursor: pointer;
            position: relative;
            transition: all 0.2s;
        }
        .remember-check input[type="checkbox"]:checked {
            background: var(--vert-foret);
            border-color: var(--vert-foret);
        }
        .remember-check input[type="checkbox"]:checked::after {
            content: '';
            position: absolute;
            left: 5px;
            top: 1px;
            width: 5px;
            height: 10px;
            border: solid #fff;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }
        .remember-check span {
            color: rgba(255,255,255,0.5);
            font-size: 0.82rem;
            font-weight: 500;
        }
        .btn-login {
            width: 100%;
            padding: 0.9rem;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--vert-foret), var(--vert-clair));
            color: #fff;
            font-weight: 700;
            font-size: 0.95rem;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            letter-spacing: 0.02em;
        }
        .btn-login::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--vert-clair), #66BB6A);
            opacity: 0;
            transition: opacity 0.3s;
        }
        .btn-login:hover::before { opacity: 1; }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(46,125,50,0.35);
        }
        .btn-login:active { transform: translateY(0); }
        .btn-login span { position: relative; z-index: 1; }
        .back-home {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1.75rem;
            padding: 0.75rem 1.5rem;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            color: rgba(255,255,255,0.55);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.25s ease;
            background: rgba(255,255,255,0.03);
        }
        .back-home:hover {
            color: #fff;
            border-color: rgba(255,255,255,0.2);
            background: rgba(255,255,255,0.06);
            transform: translateY(-1px);
        }
        .back-home i { font-size: 1rem; transition: transform 0.2s; }
        .back-home:hover i { transform: translateX(-3px); }
        .alert-premium {
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.2);
            border-radius: 12px;
            color: #fca5a5;
            padding: 0.75rem 1rem;
            font-size: 0.85rem;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .login-wrapper { animation: fadeInUp 0.6s ease-out; }
        .password-toggle {
            position: absolute;
            top: 50%;
            right: 1rem;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.3);
            font-size: 1rem;
            cursor: pointer;
            z-index: 2;
            transition: color 0.2s;
            background: none;
            border: none;
            padding: 0;
            line-height: 1;
        }
        .password-toggle:hover { color: var(--vert-clair); }
    </style>
</head>
<body>

<div class="login-wrapper">
    <div class="login-card">
        <div class="login-header">
            <div class="brand-logo">
                <img src="{{ asset('images/LOGO2.png') }}" alt="Rivière Noire">
            </div>
            <div class="brand-title">Rivière <span>Noire</span></div>
            <div class="brand-subtitle">Administration</div>
        </div>
        <div class="login-body">
            @if($errors->any())
                <div class="alert-premium">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-floating-custom">
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus placeholder=" ">
                    <label for="email">Adresse email</label>
                    <i class="bi bi-envelope input-icon"></i>
                </div>

                <div class="form-floating-custom">
                    <input type="password" name="password" id="password" required placeholder=" " style="padding-right:2.8rem;">
                    <label for="password">Mot de passe</label>
                    <button type="button" class="password-toggle" id="togglePassword" aria-label="Afficher le mot de passe">
                        <i class="bi bi-eye" id="toggleIcon"></i>
                    </button>
                </div>

                <div class="remember-row">
                    <label class="remember-check">
                        <input type="checkbox" name="remember" id="remember">
                        <span>Se souvenir de moi</span>
                    </label>
                </div>

                <button type="submit" class="btn-login">
                    <span><i class="bi bi-box-arrow-in-right me-2"></i>Se connecter</span>
                </button>
            </form>

            <a href="{{ route('home') }}" class="back-home">
                <i class="bi bi-arrow-left"></i>
                Retour à la page d'accueil
            </a>
        </div>
    </div>
</div>

<script>
document.getElementById('togglePassword').addEventListener('click', function () {
    const input = document.getElementById('password');
    const icon = document.getElementById('toggleIcon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('bi-eye', 'bi-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('bi-eye-slash', 'bi-eye');
    }
});
</script>
</body>
</html>
