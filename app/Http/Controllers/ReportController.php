<?php

namespace App\Http\Controllers;

use App\Models\IncidentReport;
use App\Services\ReportService;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ReportController extends Controller
{
    public function __construct(
        protected ReportService $reportService
    ) {}

    public function show(IncidentReport $report): mixed
    {
        return view('reports.show', compact('report'));
    }

    public function download(IncidentReport $report): BinaryFileResponse
    {
        $path = $this->reportService->downloadPdf($report);
        $fullPath = storage_path('app/' . $path);
        return response()->download($fullPath, $report->report_number . '.pdf', [
            'Content-Type' => 'application/pdf',
        ]);
    }
}
