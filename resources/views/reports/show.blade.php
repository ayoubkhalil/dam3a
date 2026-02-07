@extends('layouts.app')

@section('title', 'Rapport ' . $report->report_number)

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl border border-rose-100 shadow-sm p-6 print:border-0 print:shadow-none">
        <p class="text-sm text-gray-500 mb-2">N° {{ $report->report_number }}</p>
        <h1 class="text-xl font-semibold text-rose-600 mb-4">Rapport d’incident</h1>
        <div class="prose prose-sm max-w-none mb-6">
            <p>{{ $report->summary }}</p>
            <p><strong>Sévérité :</strong> {{ $report->severity ?? '—' }}/4</p>
            @if(!empty($report->risks))
                <p><strong>Risques / indicateurs :</strong></p>
                <ul>@foreach($report->risks as $r)<li>{{ is_array($r) ? ($r['risk'] ?? json_encode($r)) : $r }}</li>@endforeach</ul>
            @endif
            @if(!empty($report->recommendations))
                <p><strong>Recommandations :</strong></p>
                <ul>@foreach($report->recommendations as $rec)<li>{{ is_array($rec) ? ($rec['recommendation'] ?? json_encode($rec)) : $rec }}</li>@endforeach</ul>
            @endif
        </div>
        <p class="text-xs text-gray-400 mb-4">Document confidentiel — Dam3a</p>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('reports.download', $report) }}" class="inline-flex items-center bg-rose-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-rose-700">Télécharger le PDF</a>
            <button type="button" onclick="window.print()" class="inline-flex items-center text-gray-700 border border-gray-300 px-4 py-2 rounded-lg text-sm hover:bg-gray-50">Imprimer</button>
        </div>
    </div>
</div>
@endsection
