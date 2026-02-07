<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <style>
        @page {
            margin: 1.2cm;
        }
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #1b2a33;
            font-size: 12px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid #26baa5;
            padding-bottom: 8px;
            margin-bottom: 14px;
        }
        .header-brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .logo {
            width: 48px;
            height: auto;
            max-height: 42px;
            object-fit: contain;
        }
        .student-info {
            margin-top: 6px;
            border: 1px solid #d4e7ed;
            border-radius: 6px;
            padding: 6px 8px;
            background: #f7fcfb;
        }
        .info-row {
            display: flex;
            gap: 10px;
        }
        .info-row + .info-row {
            margin-top: 6px;
        }
        .info-cell {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #375f7a;
            font-size: 11px;
        }
        .info-label {
            font-weight: 700;
            color: #1f4f5f;
        }
        .info-line {
            flex: 1;
            border-bottom: 1px solid #8fbac4;
            height: 12px;
        }
        .title {
            font-size: 18px;
            font-weight: 700;
        }
        .meta {
            text-align: right;
            font-size: 11px;
            color: #375f7a;
        }
        .section {
            margin-bottom: 18px;
        }
        .section h2 {
            font-size: 14px;
            margin: 0 0 6px 0;
            color: #1f4f5f;
        }
        .pill {
            display: inline-block;
            background: #e6f7f3;
            color: #1b6d63;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 10px;
            margin-left: 8px;
        }
        .explanation {
            background: #f4fbfa;
            border: 1px solid #cfeee8;
            padding: 8px 10px;
            border-radius: 6px;
        }
        .objective {
            font-size: 11px;
            color: #375f7a;
            margin-top: 6px;
        }
        .exercise-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
        .diagnostic-table {
            width: 100%;
            border-collapse: collapse;
        }
        .diagnostic-cell {
            width: 50%;
            vertical-align: top;
            padding: 4px;
        }
        .diagnostic-item {
            border: 1px solid #d4e7ed;
            border-radius: 6px;
            padding: 6px;
        }
        .diagnostic-label {
            font-size: 11px;
            font-weight: 700;
            color: #375f7a;
            margin-bottom: 4px;
        }
        .diagnostic .division-table td {
            width: 22px;
            height: 24px;
            line-height: 24px;
            font-size: 14px;
        }
        .exercise-layout {
            width: 100%;
            border-collapse: collapse;
        }
        .exercise-col {
            width: 70%;
            vertical-align: top;
            padding-right: 12px;
        }
        .table-col {
            width: 30%;
            vertical-align: top;
        }
        .exercise-item {
            border: 1px solid #d4e7ed;
            padding: 8px;
            border-radius: 6px;
        }
        .exercise-label {
            font-weight: 600;
            margin-bottom: 6px;
            color: #2b4a5a;
        }
        .division-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 6px;
            align-items: start;
        }
        .division-table {
            border-collapse: collapse;
            margin-top: 4px;
        }
        .division-table td {
            width: 26px;
            height: 28px;
            border: 1px solid #8fbac4;
            text-align: center;
            vertical-align: middle;
            line-height: 28px;
            font-size: 16px;
        }
        .division-table .divider-left {
            border-left: 2px solid #375f7a;
        }
        .division-table .bottom-line {
            border-bottom: 2px solid #375f7a;
        }
        .digit-row {
            display: flex;
            gap: 4px;
        }
        .digit-box {
            width: 16px;
            height: 18px;
            border: 1px solid #8fbac4;
            text-align: center;
            line-height: 18px;
            font-size: 11px;
        }
        .quotient-row {
            display: flex;
            gap: 4px;
            margin-bottom: 4px;
        }
        .work-row {
            display: flex;
            gap: 4px;
            margin-top: 6px;
        }
        .divider {
            border-left: 2px solid #375f7a;
            height: 100%;
            margin-right: 4px;
        }
        .teacher-grid {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 12px;
        }
        .teacher-block {
            border: 1px solid #cfeee8;
            background: #f0fbf8;
            padding: 8px;
            border-radius: 6px;
        }
        .table-mini {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
        }
        .table-mini td {
            border: 1px solid #cfeee8;
            padding: 6px 8px;
            font-size: 13px;
            text-align: center;
            vertical-align: middle;
        }
        .answers-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            font-size: 11px;
        }
        .answers-grid div {
            padding: 4px 6px;
            border: 1px dashed #b6d6df;
            border-radius: 4px;
        }
        .page-break {
            page-break-after: always;
        }
        .muted {
            color: #5c7a87;
            font-size: 11px;
        }
        .footer {
            position: fixed;
            bottom: 0.6cm;
            left: 1.2cm;
            right: 1.2cm;
            font-size: 10px;
            color: #375f7a;
            border-top: 1px solid #d4e7ed;
            padding-top: 4px;
            text-align: center;
        }
    </style>
</head>
    @php
        $layout = $layout ?? 'default';
        $logoPath = public_path('images/logo.png');
        $logoSrc = null;
        if (file_exists($logoPath)) {
            $logoData = base64_encode(file_get_contents($logoPath));
            $logoSrc = 'data:image/png;base64,' . $logoData;
        }
    @endphp
    <body class="{{ $layout === 'diagnostic' ? 'diagnostic' : '' }}">
    @php
        $sections = $is_all ? $sections : [[
            'level' => $level,
            'exercises' => $exercises,
            'teacher_block' => $teacher_block,
            'example' => $example,
            'explanation' => $explanation,
            'objective' => $objective,
        ]];

        $diagnosticItems = [];
        if ($layout === 'diagnostic') {
            foreach ($sections as $section) {
                $firstExercise = $section['exercises'][0] ?? null;
                if ($firstExercise) {
                    $diagnosticItems[] = [
                        'level' => $section['level'],
                        'exercise' => $firstExercise,
                    ];
                }
            }
        }

        $diagnosticRows = $layout === 'diagnostic'
            ? array_chunk($diagnosticItems, 2)
            : [];

        $digits = function ($number) {
            return str_split((string) $number);
        };

        $divisionTable = function (int $dividend, int $divisor): array {
            $dividendDigits = str_split((string) $dividend);
            $divisorDigits = str_split((string) $divisor);

            $rows = count($dividendDigits) + 2;
            $leftPad = 0;
            $rightPad = 5;
            $gapCols = 1;
            $dividendCols = count($dividendDigits);
            $cols = $leftPad + $dividendCols + $gapCols + count($divisorDigits) + $rightPad;
            $grid = array_fill(0, $rows, array_fill(0, $cols, ''));

            foreach ($dividendDigits as $index => $digit) {
                $grid[0][$leftPad + $index] = $digit;
            }

            foreach ($divisorDigits as $index => $digit) {
                $grid[0][$leftPad + $dividendCols + $gapCols + $index] = $digit;
            }

            return [
                'grid' => $grid,
                'dividerCol' => $leftPad + $dividendCols + $gapCols,
            ];
        };
    @endphp

    <div class="footer">
        Telefonos: 75553338 · 71324941 · 71039910 · Web: ite.com.bo · Servicios: servicios.ite.com.bo
    </div>

    @if ($layout === 'diagnostic')
        <div class="header">
            <div class="header-brand">
                @if ($logoSrc)
                    <img class="logo" src="{{ $logoSrc }}" alt="Logo">
                @endif
                <div>
                    <div class="title">{{ $title }}</div>
                    <div class="muted">1 ejercicio por nivel en formato compacto</div>
                    <div class="student-info">
                        <div class="info-row">
                            <div class="info-cell" style="width: 50%;">
                                <span class="info-label">Estudiante</span>
                                <span class="info-line"></span>
                            </div>
                            <div class="info-cell" style="width: 50%;">
                                <span class="info-label">Colegio</span>
                                <span class="info-line"></span>
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-cell" style="width: 25%;">
                                <span class="info-label">Curso</span>
                                <span class="info-line"></span>
                            </div>
                            <div class="info-cell" style="width: 15%;">
                                <span class="info-label">Edad</span>
                                <span class="info-line"></span>
                            </div>
                            <div class="info-cell" style="width: 60%;">
                                <span class="info-label">Teléfono</span>
                                <span class="info-line"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="meta">
                <div>{{ $date->format('d/m/Y') }}</div>
                <div class="pill">DIAGNÓSTICO</div>
            </div>
        </div>

        <div class="section">
            <table class="diagnostic-table">
                @foreach ($diagnosticRows as $row)
                    <tr>
                        @foreach ($row as $item)
                            <td class="diagnostic-cell">
                                <div class="diagnostic-item">
                                    <div class="diagnostic-label">Nivel {{ $item['level']['id'] }}</div>
                                    @php
                                        $table = $divisionTable($item['exercise']['dividend'], $item['exercise']['divisor']);
                                    @endphp
                                    <table class="division-table">
                                        @foreach ($table['grid'] as $rowIndex => $gridRow)
                                            <tr>
                                                @foreach ($gridRow as $colIndex => $cell)
                                                    @php
                                                        $classes = [];
                                                        if ($rowIndex === 0 && $colIndex === $table['dividerCol']) {
                                                            $classes[] = 'divider-left';
                                                        }
                                                        if ($rowIndex === 0 && $colIndex >= $table['dividerCol']) {
                                                            $classes[] = 'bottom-line';
                                                        }
                                                    @endphp
                                                    <td class="{{ implode(' ', $classes) }}">{{ $cell }}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </td>
                        @endforeach
                        @if (count($row) === 1)
                            <td class="diagnostic-cell"></td>
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>
    @else
    @foreach ($sections as $index => $section)
        <div class="header">
            <div class="header-brand">
                @if ($logoSrc)
                    <img class="logo" src="{{ $logoSrc }}" alt="Logo">
                @endif
                <div>
                    <div class="title">{{ $title }} — {{ $section['level']['name'] }}</div>
                    <div class="muted">División entre {{ $section['level']['divisor'] }} {{ $section['level']['exact'] ? 'exacta' : 'inexacta' }}</div>
                </div>
            </div>
            <div class="meta">
                <div>{{ $date->format('d/m/Y') }}</div>
                @if (!empty($student_name))
                    <div>Estudiante: {{ $student_name }}</div>
                @endif
                <div class="pill">{{ strtoupper($type) }}</div>
            </div>
        </div>

        @if ($type === 'class' && !empty($section['teacher_block']))
            <div class="section">
                <h2>Ejercicio para pizarra</h2>
                <div class="teacher-grid">
                    <div class="teacher-block">
                        <div class="exercise-label">Para el profesor</div>
                        <div class="division-grid">
                            @php
                                $table = $divisionTable($section['teacher_block'][0]['dividend'], $section['teacher_block'][0]['divisor']);
                            @endphp
                            <table class="division-table">
                                @foreach ($table['grid'] as $rowIndex => $row)
                                    <tr>
                                        @foreach ($row as $colIndex => $cell)
                                            @php
                                                $classes = [];
                                                if ($rowIndex === 0 && $colIndex === $table['dividerCol']) {
                                                    $classes[] = 'divider-left';
                                                }
                                                if ($rowIndex === 0 && $colIndex >= $table['dividerCol']) {
                                                    $classes[] = 'bottom-line';
                                                }
                                            @endphp
                                            <td class="{{ implode(' ', $classes) }}">{{ $cell }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="teacher-block">
                        <div class="exercise-label">Para estudiantes</div>
                        @foreach (array_slice($section['teacher_block'], 1) as $studentExercise)
                            <div class="division-grid" style="margin-bottom: 8px;">
                                @php
                                    $table = $divisionTable($studentExercise['dividend'], $studentExercise['divisor']);
                                @endphp
                                <table class="division-table">
                                    @foreach ($table['grid'] as $rowIndex => $row)
                                        <tr>
                                            @foreach ($row as $colIndex => $cell)
                                                @php
                                                    $classes = [];
                                                    if ($rowIndex === 0 && $colIndex === $table['dividerCol']) {
                                                        $classes[] = 'divider-left';
                                                    }
                                                    if ($rowIndex === 0 && $colIndex >= $table['dividerCol']) {
                                                        $classes[] = 'bottom-line';
                                                    }
                                                @endphp
                                                <td class="{{ implode(' ', $classes) }}">{{ $cell }}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if ($type === 'answers')
            <div class="section">
                <h2>Respuestas</h2>
                <div class="answers-grid">
                    @foreach ($section['exercises'] as $i => $exercise)
                        <div>#{{ $i + 1 }} {{ $exercise['dividend'] }} ÷ {{ $exercise['divisor'] }} = {{ $exercise['quotient'] }} R {{ $exercise['remainder'] }}</div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="section">
                <h2>Ejercicios</h2>
                @if (!empty($include_table) && $section['level']['allow_table'])
                    <table class="exercise-layout">
                        <tr>
                            <td class="exercise-col">
                                <div class="exercise-list">
                                    @foreach ($section['exercises'] as $i => $exercise)
                                        <div class="exercise-item">
                                            <div class="exercise-label">#{{ $i + 1 }}</div>
                                            <div class="division-grid">
                                                @php
                                                    $table = $divisionTable($exercise['dividend'], $exercise['divisor']);
                                                @endphp
                                                <table class="division-table">
                                                    @foreach ($table['grid'] as $rowIndex => $row)
                                                        <tr>
                                                            @foreach ($row as $colIndex => $cell)
                                                                @php
                                                                    $classes = [];
                                                                    if ($rowIndex === 0 && $colIndex === $table['dividerCol']) {
                                                                        $classes[] = 'divider-left';
                                                                    }
                                                                    if ($rowIndex === 0 && $colIndex >= $table['dividerCol']) {
                                                                        $classes[] = 'bottom-line';
                                                                    }
                                                                @endphp
                                                                <td class="{{ implode(' ', $classes) }}">{{ $cell }}</td>
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td class="table-col">
                                <h2>Tabla del {{ $section['level']['divisor'] }}</h2>
                                <table class="table-mini">
                                    @for ($i = 1; $i <= 10; $i++)
                                        <tr>
                                            <td>{{ $section['level']['divisor'] }}</td>
                                            <td>x</td>
                                            <td>{{ $i }}</td>
                                            <td>=</td>
                                            <td>{{ $section['level']['divisor'] * $i }}</td>
                                        </tr>
                                    @endfor
                                </table>
                            </td>
                        </tr>
                    </table>
                @else
                    <div class="exercise-list">
                        @foreach ($section['exercises'] as $i => $exercise)
                            <div class="exercise-item">
                                <div class="exercise-label">#{{ $i + 1 }}</div>
                                <div class="division-grid">
                                    @php
                                        $table = $divisionTable($exercise['dividend'], $exercise['divisor']);
                                    @endphp
                                    <table class="division-table">
                                        @foreach ($table['grid'] as $rowIndex => $row)
                                            <tr>
                                                @foreach ($row as $colIndex => $cell)
                                                    @php
                                                        $classes = [];
                                                        if ($rowIndex === 0 && $colIndex === $table['dividerCol']) {
                                                            $classes[] = 'divider-left';
                                                        }
                                                        if ($rowIndex === 0 && $colIndex >= $table['dividerCol']) {
                                                            $classes[] = 'bottom-line';
                                                        }
                                                    @endphp
                                                    <td class="{{ implode(' ', $classes) }}">{{ $cell }}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif

        @if ($index < count($sections) - 1)
            <div class="page-break"></div>
        @endif
    @endforeach
    @endif
</body>
</html>
