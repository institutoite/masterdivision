<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ingreso - Division</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=space-grotesk:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="auth-page">
        <div class="auth-shell">
            <div class="auth-card">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="auth-logo">
                <h1 class="auth-title">Acceso a niveles de division</h1>
                <p class="auth-text">Inicia sesion para generar PDFs, desbloquear niveles y llevar un progreso claro.</p>

                <x-auth-session-status class="auth-text" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="grid">
                    @csrf
                    <div class="field">
                        <label for="email">Email</label>
                        <input id="email" class="auth-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                        <x-input-error :messages="$errors->get('email')" class="muted" />
                    </div>
                    <div class="field">
                        <label for="password">Password</label>
                        <input id="password" class="auth-input" type="password" name="password" required autocomplete="current-password">
                        <x-input-error :messages="$errors->get('password')" class="muted" />
                    </div>
                    <label class="checkbox">
                        <input id="remember_me" type="checkbox" name="remember">
                        <span>Recordarme</span>
                    </label>
                    <div class="auth-row">
                        @if (Route::has('password.request'))
                            <a class="auth-link" href="{{ route('password.request') }}">Olvidaste tu password?</a>
                        @endif
                        <button type="submit" class="btn primary">Ingresar</button>
                    </div>
                </form>
            </div>
            <div class="auth-panel">
                <h2>Division paso a paso</h2>
                <p class="auth-text">Un flujo por niveles que ordena la division de lo simple a lo complejo, con ejemplos claros y ejercicios guiados.</p>
                <div class="auth-steps">
                    <div class="auth-step">
                        <strong>1. Divisor fijo</strong>
                        <p class="auth-text">Empieza con divisor 2, exactas e inexactas, para dominar el reparto.</p>
                    </div>
                    <div class="auth-step">
                        <strong>2. Sin tabla</strong>
                        <p class="auth-text">Refuerza el calculo mental con dividendos mas grandes y sin apoyo visual.</p>
                    </div>
                    <div class="auth-step">
                        <strong>3. Progreso real</strong>
                        <p class="auth-text">Cada examen desbloquea el siguiente nivel para asegurar dominio antes de avanzar.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
