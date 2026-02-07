<?php

namespace App\Services;

use App\Models\BullyingAnalysis;
use App\Models\IncidentReport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ReportService
{
    /**
     * Generate incident report (DB record + optional PDF).
     */
    public function generate(BullyingAnalysis $analysis): IncidentReport
    {
        $reportNumber = 'DAM3A-' . strtoupper(Str::random(6)) . '-' . now()->format('Ymd');

        $report = IncidentReport::create([
            'analysis_id' => $analysis->id,
            'report_number' => $reportNumber,
            'summary' => $this->buildSummary($analysis),
            'severity' => $analysis->severity,
            'risks' => $analysis->risk_indicators,
            'recommendations' => $this->recommendationsFromAnalysis($analysis),
        ]);

        return $report;
    }

    /**
     * Generate PDF and store; attach path to report.
     */
    public function generatePdf(IncidentReport $report): string
    {
        $analysis = $report->analysis;
        $pdf = Pdf::loadView('reports.pdf', [
            'report' => $report,
            'analysis' => $analysis,
        ])
            ->setPaper('a4')
            ->setOption('isRemoteEnabled', true);

        $filename = 'reports/' . $report->report_number . '.pdf';
        Storage::disk('local')->put($filename, $pdf->output());
        $report->update(['pdf_path' => $filename]);

        return $filename;
    }

    /**
     * Download PDF for a report (generate if not exists).
     */
    public function downloadPdf(IncidentReport $report): ?string
    {
        if (!$report->pdf_path || !Storage::disk('local')->exists($report->pdf_path)) {
            $this->generatePdf($report);
        }
        return $report->pdf_path;
    }

    protected function buildSummary(BullyingAnalysis $analysis): string
    {
        $type = $analysis->type ?? 'non spécifié';
        $severity = $analysis->severity ?? 0;
        $lines = [
            "Type: {$type}.",
            "Sévérité: {$severity}/4.",
        ];
        if (!empty($analysis->risk_indicators)) {
            $lines[] = 'Indicateurs de risque: ' . implode(', ', $analysis->risk_indicators);
        }
        $lines[] = 'Action recommandée: ' . ($analysis->recommended_action ?? 'document_only');
        return implode(' ', $lines);
    }

    protected function recommendationsFromAnalysis(BullyingAnalysis $analysis): array
    {
        $list = [];
        if (!empty($analysis->risk_indicators)) {
            foreach ($analysis->risk_indicators as $risk) {
                $list[] = ['risk' => $risk, 'recommendation' => 'Consulter un adulte de confiance ou le centre de sécurité.'];
            }
        }
        if (empty($list)) {
            $list[] = ['risk' => 'Général', 'recommendation' => $analysis->recommended_action ?? 'Documenter et en parler à un adulte de confiance.'];
        }
        return $list;
    }
}
