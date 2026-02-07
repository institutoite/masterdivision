<?php

namespace App\Http\Controllers;

use App\Models\PdfHistory;
use App\Models\UserLevelProgress;
use App\Services\DivisionLevelService;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DivisionPdfController extends Controller
{
    public function index(Request $request, DivisionLevelService $levels)
    {
        $progress = $this->progressForUser($request->user(), $levels);

        return view('division.index', [
            'levels' => $levels->levels(),
            'history' => PdfHistory::latest()->limit(20)->get(),
            'unlockedLevelId' => $progress->unlocked_level_id,
        ]);
    }

    public function generate(Request $request, DivisionLevelService $levels)
    {
        $data = $this->validateRequest($request);

        $progress = $this->progressForUser($request->user(), $levels);

        $level = $levels->getLevel((int) $data['level_id']);
        if (!$level) {
            abort(404);
        }

        $this->assertUnlocked($level['id'], $progress);

        $count = 4;
        $isClass = $data['pdf_type'] === 'class';
        $rawCount = $isClass ? $count + 3 : $count;

        $exercises = $levels->generateExercises(
            $level,
            $rawCount,
            'media',
            null,
            null,
            (bool) ($data['progressive'] ?? false)
        );

        $teacherBlock = [];
        if ($isClass) {
            $teacherBlock = array_slice($exercises, 0, 3);
            $exercises = array_slice($exercises, 3, $count);
        }

        $example = $levels->buildExample($level, $teacherBlock, $exercises);

        $payload = [
            'title' => 'Ejercicios de División',
            'date' => Carbon::now(),
            'student_name' => null,
            'level' => $level,
            'type' => $data['pdf_type'],
            'include_table' => (bool) ($data['include_table'] ?? false),
            'exercises' => $exercises,
            'teacher_block' => $teacherBlock,
            'example' => $example,
            'explanation' => null,
            'objective' => null,
            'is_all' => false,
            'layout' => 'default',
        ];

        $fileName = $this->buildFileName($level['id'], $data['pdf_type']);
        $filePath = $this->storePdf('pdf.division', $payload, $fileName, 'letter');

        $this->saveHistory($filePath, $fileName, $data['pdf_type'], $level['id'], $payload);

        return response()->download(Storage::path($filePath));
    }

    public function generateExam(Request $request, DivisionLevelService $levels)
    {
        $data = $request->validate([
            'level_id' => ['required', 'integer', 'min:1'],
        ]);

        $progress = $this->progressForUser($request->user(), $levels);

        $level = $levels->getLevel((int) $data['level_id']);
        if (!$level) {
            abort(404);
        }

        $this->assertUnlocked($level['id'], $progress);

        $count = 4;
        $exercises = $levels->generateExercises(
            $level,
            $count,
            'media',
            null,
            null,
            false
        );

        $payload = [
            'title' => 'Examen de División',
            'date' => Carbon::now(),
            'student_name' => null,
            'level' => $level,
            'type' => 'student',
            'include_table' => false,
            'exercises' => $exercises,
            'teacher_block' => [],
            'example' => null,
            'explanation' => null,
            'objective' => null,
            'is_all' => false,
            'layout' => 'default',
        ];

        $fileName = $this->buildFileName($level['id'] . '-examen', 'student');
        $filePath = $this->storePdf('pdf.division', $payload, $fileName, 'letter');

        if ($level['id'] >= $progress->unlocked_level_id) {
            $next = min($levels->maxLevelId(), $level['id'] + 1);
            $progress->unlocked_level_id = $next;
            $progress->save();
        }

        $this->saveHistory($filePath, $fileName, 'student', $level['id'], $payload);

        return response()->download(Storage::path($filePath));
    }

    public function generateAll(Request $request, DivisionLevelService $levels)
    {
        $data = $request->validate([
            'count_per_level' => ['required', 'integer', 'min:1', 'max:60'],
        ]);

        $count = (int) $data['count_per_level'];
        $isClass = false;

        $sections = [];
        foreach ($levels->levels() as $level) {
            $rawCount = $count;
            $exercises = $levels->generateExercises(
                $level,
                $rawCount,
                'media',
                null,
                null,
                true
            );

            $teacherBlock = [];
            if ($isClass) {
                $teacherStudents = min(5, $count);
                $teacherBlock = array_slice($exercises, 0, 1 + $teacherStudents);
                $exercises = array_slice($exercises, 1 + $teacherStudents, $count);
            }

            $sections[] = [
                'level' => $level,
                'exercises' => $exercises,
                'teacher_block' => $teacherBlock,
                'example' => $levels->buildExample($level, $teacherBlock, $exercises),
                'explanation' => null,
                'objective' => null,
            ];
        }

        $payload = [
            'title' => 'Ejercicios de División',
            'date' => Carbon::now(),
            'student_name' => null,
            'type' => 'student',
            'include_table' => false,
            'sections' => $sections,
            'is_all' => true,
            'layout' => 'default',
        ];

        $fileName = $this->buildFileName('todos', 'student');
        $filePath = $this->storePdf('pdf.division', $payload, $fileName, 'letter');

        $this->saveHistory($filePath, $fileName, 'student', null, $payload);

        return response()->download(Storage::path($filePath));
    }

    public function generateDiagnostic(Request $request, DivisionLevelService $levels)
    {
        $sections = [];
        foreach ($levels->levels() as $level) {
            if ($level['id'] > 12 && $level['min'] < 1000) {
                continue;
            }

            $exercises = $levels->generateExercises(
                $level,
                1,
                'media',
                null,
                null,
                true
            );

            $sections[] = [
                'level' => $level,
                'exercises' => $exercises,
                'teacher_block' => [],
                'example' => null,
                'explanation' => null,
                'objective' => null,
            ];
        }

        $payload = [
            'title' => 'Diagnóstico de División',
            'date' => Carbon::now(),
            'student_name' => null,
            'type' => 'student',
            'include_table' => false,
            'sections' => $sections,
            'is_all' => true,
            'layout' => 'diagnostic',
        ];

        $fileName = $this->buildFileName('diagnostico', 'student');
        $filePath = $this->storePdf('pdf.division', $payload, $fileName, 'letter');

        $this->saveHistory($filePath, $fileName, 'diagnostico', null, $payload);

        return response()->download(Storage::path($filePath));
    }

    public function download(PdfHistory $history)
    {
        if (!Storage::exists($history->file_path)) {
            abort(404);
        }

        return response()->download(Storage::path($history->file_path), $history->file_name);
    }

    private function validateRequest(Request $request): array
    {
        return $request->validate([
            'level_id' => ['required', 'integer', 'min:1'],
            'include_table' => ['nullable', 'boolean'],
            'progressive' => ['nullable', 'boolean'],
            'pdf_type' => ['required', 'in:class,student'],
        ]);
    }

    private function progressForUser($user, DivisionLevelService $levels): UserLevelProgress
    {
        $progress = UserLevelProgress::firstOrCreate(
            ['user_id' => $user->id],
            ['unlocked_level_id' => 1]
        );

        $maxLevel = $levels->maxLevelId();
        if ($progress->unlocked_level_id < 1) {
            $progress->unlocked_level_id = 1;
            $progress->save();
        }

        if ($progress->unlocked_level_id > $maxLevel) {
            $progress->unlocked_level_id = $maxLevel;
            $progress->save();
        }

        return $progress;
    }

    private function assertUnlocked(int $levelId, UserLevelProgress $progress): void
    {
        if ($levelId > $progress->unlocked_level_id) {
            abort(403);
        }
    }

    private function buildFileName(string|int $levelId, string $type): string
    {
        $stamp = Carbon::now()->format('Ymd-His');
        $slug = Str::slug('nivel-' . $levelId . '-' . $type);

        return $slug . '-' . $stamp . '.pdf';
    }

    private function storePdf(string $view, array $payload, string $fileName, string $paperSize): string
    {
        $pdf = Pdf::loadView($view, $payload)->setPaper($paperSize, 'portrait');
        $path = 'pdfs/' . $fileName;
        Storage::put($path, $pdf->output());

        return $path;
    }

    private function saveHistory(string $filePath, string $fileName, string $type, ?int $levelId, array $payload): void
    {
        PdfHistory::create([
            'file_path' => $filePath,
            'file_name' => $fileName,
            'pdf_type' => $type,
            'level_id' => $levelId,
            'meta' => [
                'title' => $payload['title'],
                'is_all' => $payload['is_all'] ?? false,
                'student_name' => $payload['student_name'] ?? null,
            ],
        ]);

        $overflow = PdfHistory::latest()->skip(20)->take(100)->get();
        foreach ($overflow as $item) {
            if (Storage::exists($item->file_path)) {
                Storage::delete($item->file_path);
            }
            $item->delete();
        }
    }
}
