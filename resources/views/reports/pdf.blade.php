<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Rapport confidentiel — {{ $report->report_number }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #333; padding: 24px; }
        .watermark { position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%) rotate(-30deg); font-size: 72px; color: rgba(225,29,72,0.08); pointer-events: none; }
        h1 { color: #e11d48; font-size: 18px; margin-bottom: 8px; }
        .meta { margin-bottom: 16px; color: #666; }
        .section { margin-bottom: 12px; }
        .section h2 { font-size: 14px; color: #e11d48; margin-bottom: 4px; }
        ul { margin: 4px 0 0 16px; }
    </style>
</head>
<body>
    <div class="watermark">CONFIDENTIEL</div>
    <h1>Rapport d'incident — Dam3a</h1>
    <p class="meta">N° {{ $report->report_number }} — {{ $report->created_at->format('d/m/Y H:i') }}</p>

    <div class="section">
        <h2>Résumé</h2>
        <p>{{ $report->summary }}</p>
    </div>
    <div class="section">
        <h2>Sévérité</h2>
        <p>{{ $report->severity ?? '-' }}/4</p>
    </div>
    @if(!empty($report->risks))
    <div class="section">
        <h2>Risques / Indicateurs</h2>
        <ul>
            @foreach($report->risks as $item)
                <li>{{ is_array($item) ? ($item['risk'] ?? json_encode($item)) : $item }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(!empty($report->recommendations))
    <div class="section">
        <h2>Recommandations</h2>
        <ul>
            @foreach($report->recommendations as $item)
                <li>{{ is_array($item) ? ($item['recommendation'] ?? json_encode($item)) : $item }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <p style="margin-top: 24px; font-size: 10px; color: #999;">Document confidentiel — Plateforme Dam3a, soutien anti-harcèlement.</p>
</body>
</html>
