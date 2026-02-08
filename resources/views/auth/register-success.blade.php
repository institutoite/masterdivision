<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro exitoso - Division</title>
    <link rel="icon" href="{{ asset('images/ite.ico') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=space-grotesk:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
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
                <p class="eyebrow">Inversion en conocimiento</p>
                <h1>Acceso inmediato por Bs. 20</h1>
                <p class="subtitle">Escanea el QR para activar tu acceso y recibir todo el material.</p>
                <p class="subtitle" style="margin-top: 8px;">Tu acceso se habilita cuando confirmemos el pago.</p>
                <div class="landing-cta">
                    <a class="btn ghost" href="{{ route('verification.pending') }}">Verificacion de pago</a>
                </div>
            </div>
            <div class="landing-card">
                <div style="display: flex; flex-direction: column; align-items: center; gap: 10px;">
                    <img src="{{ asset('images/qr.jpg') }}" alt="QR de pago" style="width: 240px; max-width: 100%; border-radius: 12px;">
                    <a class="btn secondary" href="{{ asset('images/qr.jpg') }}" download>Descargar QR</a>
                </div>
                <p class="subtitle" style="margin-top: 12px; text-align: center;">Guarda el QR en tu galeria para escanear desde la app del movil.</p>
            </div>
        </header>

        <section class="step-grid">
            <div class="landing-card">
                <h2>⭐ Beneficios incluidos</h2>
                <ul class="subtitle" style="margin-top: 12px; padding-left: 18px;">
                    <li><span style="color: #16a34a; font-weight: 700;">✔</span> Diagnóstico inicial</li>
                    <li><span style="color: #16a34a; font-weight: 700;">✔</span> Libro completo en PDF</li>
                    <li><span style="color: #16a34a; font-weight: 700;">✔</span> PDFs por niveles</li>
                    <li><span style="color: #16a34a; font-weight: 700;">✔</span> Ejercicios ilimitados</li>
                    <li><span style="color: #16a34a; font-weight: 700;">✔</span> Examenes imprimibles</li>
                    <li><span style="color: #16a34a; font-weight: 700;">✔</span> Acceso inmediato con QR</li>
                </ul>
                <div style="margin-top: 16px; display: flex; flex-direction: column; gap: 10px; align-items: center;">
                    <button class="btn" type="button" id="paid-button" style="background: #16a34a; color: #ffffff; width: 100%; max-width: 320px; text-align: center;">Pagado</button>
                    <form id="proof-form" action="{{ route('payment.proof.store') }}" method="POST" enctype="multipart/form-data" style="width: 100%; max-width: 320px; display: none; gap: 8px; flex-direction: column;">
                        @csrf
                        <label for="payment-proof" class="subtitle" style="color: #16a34a; font-weight: 600;">Sube tu comprobante de pago</label>
                        <input id="payment-proof" name="payment_proof" type="file" accept="image/*,.pdf" required>
                        <button class="btn primary" type="submit">Enviar comprobante</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <script>
        const paidButton = document.getElementById('paid-button');
        const proofForm = document.getElementById('proof-form');

        paidButton.addEventListener('click', () => {
            const isHidden = proofForm.style.display === 'none';
            proofForm.style.display = isHidden ? 'flex' : 'none';
        });
    </script>
</body>
</html>
