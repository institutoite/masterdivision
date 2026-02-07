<?php

namespace App\Services;

class DivisionLevelService
{
    public function levels(): array
    {
        $levels = [];

        $levels = array_merge($levels, $this->buildDivisor2Levels());
        $levels = array_merge($levels, $this->buildDivisor3Levels(13));

        $nextId = 25;
        for ($divisor = 4; $divisor <= 9; $divisor++) {
            $levels = array_merge($levels, $this->buildGenericDivisorLevels($divisor, $nextId));
            $nextId += 12;
        }

        return $levels;
    }

    public function getLevel(int $id): ?array
    {
        foreach ($this->levels() as $level) {
            if ($level['id'] === $id) {
                return $level;
            }
        }

        return null;
    }

    public function maxLevelId(): int
    {
        $ids = array_map(static fn (array $level) => $level['id'], $this->levels());

        return (int) max($ids);
    }

    public function explanationText(array $level): string
    {
        $type = $level['exact'] ? 'exacta' : 'inexacta';
        $divisor = $level['divisor'];
        $range = $level['min'] . ' a ' . $level['max'];

        return 'Division entre ' . $divisor . ' ' . $type . ' con dividendos en el rango ' . $range . '.';
    }

    public function buildExample(array $level, array $teacherBlock, array $exercises): ?array
    {
        if (!empty($teacherBlock)) {
            return $teacherBlock[0];
        }

        return $exercises[0] ?? null;
    }

    public function generateExercises(
        array $level,
        int $count,
        string $difficulty,
        ?int $rangeMin,
        ?int $rangeMax,
        bool $progressive
    ): array {
        $min = max($level['min'], $rangeMin ?? $level['min']);
        $max = min($level['max'], $rangeMax ?? $level['max']);

        if ($min > $max) {
            [$min, $max] = [$level['min'], $level['max']];
        }

        [$min, $max] = $this->applyDifficulty($min, $max, $difficulty);

        $results = [];
        $attempts = 0;
        $maxAttempts = $count * 50;

        while (count($results) < $count && $attempts < $maxAttempts) {
            $attempts++;
            $dividend = random_int($min, $max);

            if (!$this->validDigits($dividend, $level)) {
                continue;
            }

            if (!$this->validRemainder($dividend, $level)) {
                continue;
            }

            if (in_array($dividend, $results, true)) {
                continue;
            }

            $results[] = $dividend;
        }

        if (count($results) < $count) {
            for ($dividend = $min; $dividend <= $max && count($results) < $count; $dividend++) {
                if (in_array($dividend, $results, true)) {
                    continue;
                }

                if (!$this->validDigits($dividend, $level)) {
                    continue;
                }

                if (!$this->validRemainder($dividend, $level)) {
                    continue;
                }

                $results[] = $dividend;
            }
        }

        sort($results);

        if (!$progressive && !$level['force_order']) {
            shuffle($results);
        }

        return array_map(function (int $dividend) use ($level) {
            $divisor = $level['divisor'];
            $quotient = intdiv($dividend, $divisor);
            $remainder = $dividend % $divisor;

            return [
                'dividend' => $dividend,
                'divisor' => $divisor,
                'quotient' => $quotient,
                'remainder' => $remainder,
            ];
        }, $results);
    }

    private function buildDivisor2Levels(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'Nivel 1',
                'divisor' => 2,
                'exact' => true,
                'min' => 4,
                'max' => 18,
                'allow_table' => true,
                'force_order' => true,
                'objective' => 'Comprender la division como reparto exacto.',
            ],
            [
                'id' => 2,
                'name' => 'Nivel 2',
                'divisor' => 2,
                'exact' => false,
                'min' => 5,
                'max' => 19,
                'allow_table' => true,
                'force_order' => true,
                'remainder_allowed' => [1],
                'objective' => 'Introducir el concepto de resto.',
            ],
            [
                'id' => 3,
                'name' => 'Nivel 3',
                'divisor' => 2,
                'exact' => true,
                'min' => 21,
                'max' => 99,
                'allow_table' => false,
                'force_order' => true,
                'objective' => 'Afianzar el calculo mental sin apoyo visual.',
            ],
            [
                'id' => 4,
                'name' => 'Nivel 4',
                'divisor' => 2,
                'exact' => false,
                'min' => 21,
                'max' => 99,
                'allow_table' => false,
                'force_order' => true,
                'remainder_allowed' => [1],
                'objective' => 'Dominar el resto sin apoyo de la tabla.',
            ],
            [
                'id' => 5,
                'name' => 'Nivel 5',
                'divisor' => 2,
                'exact' => true,
                'min' => 101,
                'max' => 999,
                'allow_table' => false,
                'force_order' => true,
                'objective' => 'Fortalecer la division larga con resultados exactos.',
            ],
            [
                'id' => 6,
                'name' => 'Nivel 6',
                'divisor' => 2,
                'exact' => false,
                'min' => 101,
                'max' => 999,
                'allow_table' => false,
                'force_order' => true,
                'remainder_allowed' => [1],
                'objective' => 'Manejar restos en divisiones largas.',
            ],
            [
                'id' => 7,
                'name' => 'Nivel 7',
                'divisor' => 2,
                'exact' => true,
                'min' => 1000,
                'max' => 9999,
                'allow_table' => false,
                'force_order' => true,
                'digits_allowed' => [2, 3, 4, 5, 6, 7, 8, 9],
                'last_digit' => 'even',
                'objective' => 'Proceso continuo sin casos especiales.',
            ],
            [
                'id' => 8,
                'name' => 'Nivel 8',
                'divisor' => 2,
                'exact' => false,
                'min' => 1000,
                'max' => 9999,
                'allow_table' => false,
                'force_order' => true,
                'digits_allowed' => [2, 3, 4, 5, 6, 7, 8, 9],
                'last_digit' => 'odd',
                'last_digit_not' => [1],
                'remainder_allowed' => [1],
                'objective' => 'Trabajar resto sin interrupciones del algoritmo.',
            ],
            [
                'id' => 9,
                'name' => 'Nivel 9',
                'divisor' => 2,
                'exact' => true,
                'min' => 10000,
                'max' => 99999,
                'allow_table' => false,
                'force_order' => true,
                'digits_allowed' => [2, 3, 4, 5, 6, 7, 8, 9],
                'last_digit' => 'even',
                'objective' => 'Division larga exacta con numeros de cinco digitos.',
            ],
            [
                'id' => 10,
                'name' => 'Nivel 10',
                'divisor' => 2,
                'exact' => false,
                'min' => 10000,
                'max' => 99999,
                'allow_table' => false,
                'force_order' => true,
                'digits_allowed' => [2, 3, 4, 5, 6, 7, 8, 9],
                'last_digit' => 'odd',
                'last_digit_not' => [1],
                'remainder_allowed' => [1],
                'objective' => 'Precision en cociente y resto con cinco digitos.',
            ],
            [
                'id' => 11,
                'name' => 'Nivel 11',
                'divisor' => 2,
                'exact' => true,
                'min' => 100000,
                'max' => 999999,
                'allow_table' => false,
                'force_order' => true,
                'digits_allowed' => [2, 3, 4, 5, 6, 7, 8, 9],
                'last_digit' => 'even',
                'objective' => 'Division larga exacta con seis digitos.',
            ],
            [
                'id' => 12,
                'name' => 'Nivel 12',
                'divisor' => 2,
                'exact' => false,
                'min' => 100000,
                'max' => 999999,
                'allow_table' => false,
                'force_order' => true,
                'digits_allowed' => [2, 3, 4, 5, 6, 7, 8, 9],
                'last_digit' => 'odd',
                'last_digit_not' => [1],
                'remainder_allowed' => [1],
                'objective' => 'Manejar restos con numeros grandes.',
            ],
        ];
    }

    private function buildDivisor3Levels(int $startId): array
    {
        $levels = $this->buildGenericDivisorLevels(3, $startId);

        foreach ($levels as &$level) {
            if ($level['id'] >= $startId + 6) {
                $level['digits_allowed'] = [3, 4, 5, 6, 7, 8, 9];
            }

            if (!$level['exact']) {
                $level['remainder_allowed'] = [1, 2];
            }
        }

        return $levels;
    }

    private function buildGenericDivisorLevels(int $divisor, int $startId): array
    {
        $smallMax = $divisor * 10;
        $levels = [
            [
                'id' => $startId,
                'name' => 'Nivel ' . $startId,
                'divisor' => $divisor,
                'exact' => true,
                'min' => $divisor * 2,
                'max' => $smallMax - 2,
                'allow_table' => true,
                'force_order' => true,
                'objective' => 'Comprender la division como reparto exacto.',
            ],
            [
                'id' => $startId + 1,
                'name' => 'Nivel ' . ($startId + 1),
                'divisor' => $divisor,
                'exact' => false,
                'min' => $divisor * 2 + 1,
                'max' => $smallMax - 1,
                'allow_table' => true,
                'force_order' => true,
                'objective' => 'Introducir el concepto de resto.',
            ],
            [
                'id' => $startId + 2,
                'name' => 'Nivel ' . ($startId + 2),
                'divisor' => $divisor,
                'exact' => true,
                'min' => $smallMax + 1,
                'max' => 99,
                'allow_table' => false,
                'force_order' => true,
                'objective' => 'Afianzar el calculo mental sin apoyo visual.',
            ],
            [
                'id' => $startId + 3,
                'name' => 'Nivel ' . ($startId + 3),
                'divisor' => $divisor,
                'exact' => false,
                'min' => $smallMax + 1,
                'max' => 99,
                'allow_table' => false,
                'force_order' => true,
                'objective' => 'Dominar el resto sin apoyo de la tabla.',
            ],
            [
                'id' => $startId + 4,
                'name' => 'Nivel ' . ($startId + 4),
                'divisor' => $divisor,
                'exact' => true,
                'min' => 101,
                'max' => 999,
                'allow_table' => false,
                'force_order' => true,
                'objective' => 'Fortalecer la division larga con resultados exactos.',
            ],
            [
                'id' => $startId + 5,
                'name' => 'Nivel ' . ($startId + 5),
                'divisor' => $divisor,
                'exact' => false,
                'min' => 101,
                'max' => 999,
                'allow_table' => false,
                'force_order' => true,
                'objective' => 'Manejar restos en divisiones largas.',
            ],
            [
                'id' => $startId + 6,
                'name' => 'Nivel ' . ($startId + 6),
                'divisor' => $divisor,
                'exact' => true,
                'min' => 1000,
                'max' => 9999,
                'allow_table' => false,
                'force_order' => true,
                'objective' => 'Proceso continuo sin casos especiales.',
            ],
            [
                'id' => $startId + 7,
                'name' => 'Nivel ' . ($startId + 7),
                'divisor' => $divisor,
                'exact' => false,
                'min' => 1000,
                'max' => 9999,
                'allow_table' => false,
                'force_order' => true,
                'objective' => 'Trabajar resto sin interrupciones del algoritmo.',
            ],
            [
                'id' => $startId + 8,
                'name' => 'Nivel ' . ($startId + 8),
                'divisor' => $divisor,
                'exact' => true,
                'min' => 10000,
                'max' => 99999,
                'allow_table' => false,
                'force_order' => true,
                'objective' => 'Division larga exacta con numeros grandes.',
            ],
            [
                'id' => $startId + 9,
                'name' => 'Nivel ' . ($startId + 9),
                'divisor' => $divisor,
                'exact' => false,
                'min' => 10000,
                'max' => 99999,
                'allow_table' => false,
                'force_order' => true,
                'objective' => 'Precision absoluta en cociente y resto.',
            ],
            [
                'id' => $startId + 10,
                'name' => 'Nivel ' . ($startId + 10),
                'divisor' => $divisor,
                'exact' => true,
                'min' => 100000,
                'max' => 999999,
                'allow_table' => false,
                'force_order' => true,
                'objective' => 'Fluidez total con numeros grandes.',
            ],
            [
                'id' => $startId + 11,
                'name' => 'Nivel ' . ($startId + 11),
                'divisor' => $divisor,
                'exact' => false,
                'min' => 100000,
                'max' => 999999,
                'allow_table' => false,
                'force_order' => true,
                'objective' => 'Dominio completo antes de avanzar.',
            ],
        ];

        foreach ($levels as &$level) {
            if (!$level['exact'] && empty($level['remainder_allowed'])) {
                $level['remainder_allowed'] = $this->defaultRemainders($divisor);
            }
        }

        return $levels;
    }

    private function defaultRemainders(int $divisor): array
    {
        return range(1, max(1, $divisor - 1));
    }

    private function applyDifficulty(int $min, int $max, string $difficulty): array
    {
        if ($min === $max) {
            return [$min, $max];
        }

        $span = $max - $min;
        $slice = max(1, (int) floor($span * 0.4));

        return match ($difficulty) {
            'baja' => [$min, $min + $slice],
            'alta' => [$max - $slice, $max],
            default => [$min + (int) floor($span * 0.3), $max - (int) floor($span * 0.3)],
        };
    }

    private function validDigits(int $dividend, array $level): bool
    {
        if (empty($level['digits_allowed']) && empty($level['digits_excluded'])) {
            return true;
        }

        $digits = str_split((string) $dividend);

        if (!empty($level['digits_allowed'])) {
            foreach ($digits as $digit) {
                if (!in_array((int) $digit, $level['digits_allowed'], true)) {
                    return false;
                }
            }
        }

        if (!empty($level['digits_excluded'])) {
            foreach ($digits as $digit) {
                if (in_array((int) $digit, $level['digits_excluded'], true)) {
                    return false;
                }
            }
        }

        if (!empty($level['last_digit'])) {
            $last = (int) substr((string) $dividend, -1);
            if ($level['last_digit'] === 'even' && $last % 2 !== 0) {
                return false;
            }
            if ($level['last_digit'] === 'odd' && $last % 2 === 0) {
                return false;
            }
        }

        if (!empty($level['last_digit_not'])) {
            $last = (int) substr((string) $dividend, -1);
            if (in_array($last, $level['last_digit_not'], true)) {
                return false;
            }
        }

        return true;
    }

    private function validRemainder(int $dividend, array $level): bool
    {
        $divisor = $level['divisor'];
        $remainder = $dividend % $divisor;

        if ($level['exact'] && $remainder !== 0) {
            return false;
        }

        if (!$level['exact'] && $remainder === 0) {
            return false;
        }

        if (!empty($level['remainder_allowed']) && !in_array($remainder, $level['remainder_allowed'], true)) {
            return false;
        }

        return true;
    }
}
