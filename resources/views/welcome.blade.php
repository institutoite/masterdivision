@php
	$whatsappMessage = rawurlencode('Hola, me interesa aprender a dividir y conocer los niveles disponibles.');
@endphp
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Master Division</title>
		<link rel="icon" href="{{ asset('images/ite.ico') }}">
		<link rel="preconnect" href="https://fonts.bunny.net">
		<link href="https://fonts.bunny.net/css?family=space-grotesk:400,500,600,700" rel="stylesheet" />
		@vite(['resources/css/app.css', 'resources/js/app.js'])
	</head>
	<body>
		<div class="page">
			<header class="hero">
				<div class="hero-text">
					<img src="{{ asset('images/logo.png') }}" alt="Logo" class="auth-logo">
					<p class="eyebrow">Division paso a paso</p>
					<h1>Una ruta clara para dominar la division</h1>
					<p class="subtitle">Niveles ordenados, PDF listos para imprimir y un progreso que desbloquea cada etapa.</p>
					<div class="landing-cta">
						@auth
							<a class="btn primary" href="{{ route('dashboard') }}">Ir al panel</a>
						@else
							<a class="btn primary" href="{{ route('login') }}">Iniciar sesion</a>
							@if (Route::has('register'))
								<a class="btn secondary" href="{{ route('register') }}">Crear cuenta</a>
							@endif
							<a class="btn ghost" href="https://wa.me/5911039910?text={{ $whatsappMessage }}" target="_blank" rel="noopener noreferrer">Contactos</a>
						@endauth
					</div>
				</div>
				<div class="hero-badge">
					<div class="badge-ring"></div>
					<div class="badge-core">
						<span>PDF</span>
						<small>Rapido y claro</small>
					</div>
				</div>
			</header>

			<section class="step-grid">
				<div class="landing-card">
					<h2>Aprendizaje seguro en 4 pasos</h2>
					<div class="step-grid">
						<div class="step-item">
							<strong>1. Divisor fijo</strong>
							<p class="subtitle">Exactas e inexactas con numeros cortos.</p>
						</div>
						<div class="step-item">
							<strong>2. Sin tabla</strong>
							<p class="subtitle">Calculo mental con rangos mayores.</p>
						</div>
						<div class="step-item">
							<strong>3. Division larga</strong>
							<p class="subtitle">Tres, cuatro, cinco y mas digitos.</p>
						</div>
						<div class="step-item">
							<strong>4. Examen</strong>
							<p class="subtitle">Desbloqueo por dominio real del nivel.</p>
						</div>
					</div>
				</div>
			</section>

			<section class="step-grid">
				<div class="landing-card">
					<h2>Para profesores</h2>
					<p class="subtitle">PDF listos con formato boliviano, niveles ordenados y control de avance por examen.</p>
				</div>
				<div class="landing-card">
					<h2>Para estudiantes</h2>
					<p class="subtitle">Ejercicios claros, espacios amplios y practica guiada en cada etapa.</p>
				</div>
			</section>
		</div>
	</body>
</html>
