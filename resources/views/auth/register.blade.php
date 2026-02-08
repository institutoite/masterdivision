<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro - Division</title>
    <link rel="icon" href="{{ asset('images/ite.ico') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=space-grotesk:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="auth-page">
        <div class="auth-shell">
            <div class="auth-card">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="auth-logo">
                <h1 class="auth-title">Crea tu cuenta</h1>
                <p class="auth-text">Registra tus datos para acceder a los niveles, generar PDFs y guardar tu progreso.</p>

                <form method="POST" action="{{ route('register') }}" class="grid">
                    @csrf
                    <div class="field">
                        <label for="name">Nombre completo</label>
                        <input id="name" class="auth-input" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                        <x-input-error :messages="$errors->get('name')" class="muted" />
                    </div>
                    <div class="field">
                        <label for="email">Email</label>
                        <input id="email" class="auth-input" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                        <x-input-error :messages="$errors->get('email')" class="muted" />
                    </div>
                    <div class="field">
                        <label for="password">Password</label>
                        <div class="password-field">
                            <input id="password" class="auth-input" type="password" name="password" required autocomplete="new-password">
                            <button type="button" class="password-toggle" data-password-toggle aria-label="Mostrar u ocultar password" aria-pressed="false">
                                <svg class="eye-open" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M2 12s4-6 10-6 10 6 10 6-4 6-10 6-10-6-10-6Z" />
                                    <circle cx="12" cy="12" r="3.5" />
                                </svg>
                                <svg class="eye-closed" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M3 3l18 18" />
                                    <path d="M10.6 10.6a3.5 3.5 0 0 0 4.8 4.8" />
                                    <path d="M6.5 6.5C4 8.3 2.5 10.7 2 12c1.5 2.2 5.3 6 10 6 1.6 0 3-.3 4.3-.8" />
                                    <path d="M17.5 17.5C20 15.7 21.5 13.3 22 12c-1.5-2.2-5.3-6-10-6-1.6 0-3 .3-4.3.8" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="muted" />
                    </div>
                    <div class="field">
                        <label for="password_confirmation">Confirmar password</label>
                        <div class="password-field">
                            <input id="password_confirmation" class="auth-input" type="password" name="password_confirmation" required autocomplete="new-password">
                            <button type="button" class="password-toggle" data-password-toggle aria-label="Mostrar u ocultar password" aria-pressed="false">
                                <svg class="eye-open" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M2 12s4-6 10-6 10 6 10 6-4 6-10 6-10-6-10-6Z" />
                                    <circle cx="12" cy="12" r="3.5" />
                                </svg>
                                <svg class="eye-closed" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M3 3l18 18" />
                                    <path d="M10.6 10.6a3.5 3.5 0 0 0 4.8 4.8" />
                                    <path d="M6.5 6.5C4 8.3 2.5 10.7 2 12c1.5 2.2 5.3 6 10 6 1.6 0 3-.3 4.3-.8" />
                                    <path d="M17.5 17.5C20 15.7 21.5 13.3 22 12c-1.5-2.2-5.3-6-10-6-1.6 0-3 .3-4.3.8" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="muted" />
                    </div>
                    <div class="auth-row">
                        <a class="auth-link" href="{{ route('login') }}">Ya tienes cuenta?</a>
                        <button type="submit" class="btn primary">Crear cuenta</button>
                    </div>
                </form>
            </div>
            <div class="auth-panel">
                <h2>Aprende division con orden</h2>
                <p class="auth-text">Empieza con ejercicios claros, practica con PDF listos para imprimir y desbloquea niveles con cada examen.</p>
                <div class="auth-steps">
                    <div class="auth-step">
                        <strong>Material imprimible</strong>
                        <p class="auth-text">Hojas listas para aula y estudio personal, sin perder tiempo formateando.</p>
                    </div>
                    <div class="auth-step">
                        <strong>Rutas guiadas</strong>
                        <p class="auth-text">Cada nivel aumenta la dificultad con un camino claro y medible.</p>
                    </div>
                    <div class="auth-step">
                        <strong>Progreso visible</strong>
                        <p class="auth-text">Solo avanzas cuando dominas el nivel, manteniendo un aprendizaje firme.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
