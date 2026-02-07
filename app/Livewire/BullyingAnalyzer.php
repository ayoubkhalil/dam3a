<?php

namespace App\Livewire;

use App\Models\BullyingAnalysis;
use App\Services\BullyingAnalysisService;
use App\Services\ReportService;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

#[Layout('layouts.app')]
class BullyingAnalyzer extends Component
{
    public bool $showUserModal = true;
    public ?int $analysisId = null;
    public ?array $result = null;

    public string $alias = '';
    public ?int $age = null;
    public string $city = '';
    public string $school = '';

    #[Validate('required|string|max:5000')]
    public string $incidentText = '';

    public function skipUserInfo(): void
    {
        $this->showUserModal = false;
    }

    public function submitUserInfo(): void
    {
        $this->validate([
            'alias' => 'nullable|string|max:100',
            'age' => 'nullable|integer|min:10|max:25',
            'city' => 'nullable|string|max:100',
            'school' => 'nullable|string|max:200',
        ]);
        $this->showUserModal = false;
    }

    public function analyze(BullyingAnalysisService $analysisService): void
    {
        $this->validateOnly('incidentText');
        $analysis = $analysisService->analyze(
            $this->incidentText,
            $this->alias ?: null,
            $this->age,
            $this->city ?: null,
            $this->school ?: null
        );
        $this->analysisId = $analysis->id;
        $this->result = [
            'type' => $analysis->type,
            'severity' => $analysis->severity,
            'risk_indicators' => $analysis->risk_indicators,
            'recommended_action' => $analysis->recommended_action,
        ];
    }

    public function generateReport(ReportService $reportService): void
    {
        if (!$this->analysisId) {
            return;
        }
        $analysis = BullyingAnalysis::findOrFail($this->analysisId);
        $report = $analysis->incidentReport;
        if (!$report) {
            $report = $reportService->generate($analysis);
        }
        $this->redirectRoute('reports.show', $report);
    }

    public function render()
    {
        return view('livewire.bullying-analyzer');
    }
}
