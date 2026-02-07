<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Generador de Division</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=space-grotesk:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="page">
        <header class="hero">
            <div class="hero-text">
                <p class="eyebrow">Metodo por niveles</p>
                <h1>Generador de PDF de ejercicios de Division</h1>
                <p class="subtitle">Selecciona el nivel, ajusta la dificultad y exporta en formato para clase o para estudiante.</p>
            </div>
            <div class="hero-badge">
                <div class="badge-ring"></div>
                <div class="badge-core">
                    <span>PDF</span>
                    <small>Rapido y claro</small>
                </div>
            </div>
        </header>

        <section class="card form-card">
            <div class="section-title">
                <h2>Niveles disponibles</h2>
                <p>Selecciona el nivel y genera el PDF correspondiente.</p>
            </div>
            <div class="level-grid">
                @foreach ($levels as $level)
                    @php
                        $locked = $level['id'] > $unlockedLevelId;
                    @endphp
                    <div class="level-card">
                        <div class="level-head">
                            <div>
                                <h3>{{ $level['name'] }}</h3>
                                <p>Division entre {{ $level['divisor'] }} {{ $level['exact'] ? 'exacta' : 'inexacta' }}</p>
                            </div>
                            @if ($locked)
                                <span class="lock-badge">Bloqueado</span>
                            @else
                                <span class="level-pill">Rango {{ $level['min'] }} - {{ $level['max'] }}</span>
                            @endif
                        </div>
                        <form method="POST" action="{{ route('division.generate') }}" class="level-form">
                            @csrf
                            <input type="hidden" name="level_id" value="{{ $level['id'] }}">
                            <input type="hidden" name="pdf_type" value="class">
                            <label class="checkbox">
                                <input type="checkbox" name="include_table" value="1" @if(!$level['allow_table']) disabled @endif>
                                <span>Incluir tabla de multiplicar</span>
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="progressive" value="1">
                                <span>Modo progresivo</span>
                            </label>
                            <div class="actions">
                                <button type="submit" class="btn primary" name="pdf_type" value="class" @if($locked) disabled @endif>Generar PDF Para Clase</button>
                                <button type="submit" class="btn secondary" name="pdf_type" value="student" @if($locked) disabled @endif>Generar PDF Para Estudiante</button>
                                <button type="submit" class="btn ghost" formaction="{{ route('division.exam') }}" @if($locked) disabled @endif>Examen</button>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="card form-card">
            <form method="POST" action="{{ route('division.generate.all') }}" class="grid" id="all-form">
                @csrf
                <div class="field">
                    <label for="count_per_level">Ejercicios por nivel</label>
                    <input type="number" id="count_per_level" name="count_per_level" min="1" max="60" value="5" required>
                </div>

                <div class="actions">
                    <button type="submit" class="btn primary">Generar PDF Todos los Niveles</button>
                </div>
            </form>
        </section>

        <section class="card form-card">
            <form method="POST" action="{{ route('division.diagnostic') }}" class="grid">
                @csrf
                <div class="field">
                    <label>PDF Diagnostico</label>
                    <p class="muted">Incluye 1 ejercicio por nivel, en formato compacto para ahorrar hojas.</p>
                </div>
                <div class="actions">
                    <button type="submit" class="btn secondary">Generar PDF Diagnostico</button>
                </div>
            </form>
        </section>

        <section class="card history-card">
            <div class="card-header">
                <h2>Historial (ultimos 20)</h2>
            </div>
            <div class="history-list">
                @forelse ($history as $item)
                    <div class="history-item">
                        <div>
                            <p class="history-title">{{ $item->file_name }}</p>
                            <p class="history-meta">Tipo: {{ strtoupper($item->pdf_type) }} @if($item->level_id) | Nivel {{ $item->level_id }} @else | Todos @endif</p>
                        </div>
                        <a class="btn ghost" href="{{ route('division.download', $item) }}">Descargar</a>
                    </div>
                @empty
                    <p class="muted">Aun no hay PDFs generados.</p>
                @endforelse
            </div>
        </section>
    </div>
</body>
</html>
