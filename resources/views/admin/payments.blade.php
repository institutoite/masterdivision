<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pagos - Admin</title>
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
                <p class="eyebrow">Administracion</p>
                <h1>Pagos y accesos</h1>
                <p class="subtitle">Aprueba pagos para habilitar el panel de los usuarios.</p>
            </div>
        </header>

        <section class="card form-card">
            <div class="section-title">
                <h2>Usuarios registrados</h2>
                <p>Marca como pagado para dar acceso al panel.</p>
            </div>
            <div class="history-list">
                @foreach ($users as $user)
                    @php
                        $latestProof = $user->paymentProofs->sortByDesc('created_at')->first();
                    @endphp
                    <div class="history-item">
                        <div>
                            <p class="history-title">{{ $user->name }}</p>
                            <p class="history-meta">{{ $user->email }}</p>
                            @if ($latestProof)
                                <p class="history-meta">Comprobante: {{ $latestProof->original_name }}</p>
                                <a class="btn ghost" href="{{ asset('storage/' . $latestProof->path) }}" target="_blank" rel="noopener noreferrer">Ver comprobante</a>
                            @else
                                <p class="history-meta">Comprobante: pendiente</p>
                            @endif
                        </div>
                        <div class="actions">
                            @if ($user->is_paid)
                                <span class="level-pill">Pagado</span>
                                <form method="POST" action="{{ route('admin.payments.revoke', $user) }}">
                                    @csrf
                                    <button type="submit" class="btn ghost">Revocar</button>
                                </form>
                            @else
                                <span class="lock-badge">Pendiente</span>
                                <form method="POST" action="{{ route('admin.payments.approve', $user) }}">
                                    @csrf
                                    <button type="submit" class="btn primary">Aprobar</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
</body>
</html>
