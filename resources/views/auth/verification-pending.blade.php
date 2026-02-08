<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verificacion de pago - Division</title>
    <link rel="icon" href="{{ asset('images/ite.ico') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=space-grotesk:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .verification-page {
            --primary: rgb(38, 186, 165);
            --secondary: rgb(55, 95, 122);
            background: linear-gradient(180deg, rgba(38, 186, 165, 0.08), rgba(255, 255, 255, 0));
        }
        .verification-page .eyebrow {
            color: var(--primary);
            letter-spacing: 0.12em;
        }
        .verification-page h1,
        .verification-page h2 {
            color: var(--secondary);
        }
        .verification-page .subtitle {
            color: var(--secondary);
        }
        .verification-page .btn.secondary {
            background: var(--primary);
            border-color: var(--primary);
            color: #ffffff;
        }
        .verification-page .btn.ghost {
            border-color: var(--secondary);
            color: var(--secondary);
        }
        .verification-page .landing-card {
            border: 1px solid rgba(55, 95, 122, 0.2);
            box-shadow: 0 16px 30px rgba(55, 95, 122, 0.08);
        }
        .verification-page .status-text,
        .verification-page .check-mark {
            color: var(--primary);
        }
    </style>
</head>
<body class="verification-page">
    <div style="display: flex; justify-content: flex-end; padding: 16px 24px;">
        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn secondary">Cerrar sesion</button>
            </form>
        @endauth
    </div>
    <div class="page">
        <header class="hero">
            <div class="hero-text">
                <p class="eyebrow">Verificacion</p>
                <h1>Estamos verificando tu pago</h1>
                <p class="subtitle">Apenas confirmemos el pago, habilitaremos tu acceso al panel.</p>
                @if (session('status'))
                    <p class="subtitle status-text" style="margin-top: 10px; font-weight: 600;">{{ session('status') }}</p>
                @endif
                <div class="landing-cta">
                    <a class="btn ghost" href="{{ route('register.success') }}">Ver QR de pago</a>
                    <a class="btn secondary" href="https://wa.me/59171039910?text=He%20pagado%20Bs.%2020%20para%20acceder%20a%20divisionpasoapaso.ite.com.bo" target="_blank" rel="noopener noreferrer">Enviar WhatsApp</a>
                </div>
            </div>
            <div class="landing-card">
                <h2>Que sigue?</h2>
                <p class="subtitle">Si ya pagaste, espera la aprobacion del administrador.</p>
                <p class="subtitle" style="margin-top: 10px;">Si deseas avisarnos, usa el boton de WhatsApp con el mensaje predefinido.</p>
                <ul class="subtitle" style="margin-top: 12px; padding-left: 18px;">
                    <li><span class="check-mark" style="font-weight: 700;">✔</span> Revisamos tu comprobante</li>
                    <li><span class="check-mark" style="font-weight: 700;">✔</span> Activamos tu acceso</li>
                    <li><span class="check-mark" style="font-weight: 700;">✔</span> Te avisamos cuando este listo</li>
                </ul>
            </div>
        </header>
    </div>
</body>
</html>
