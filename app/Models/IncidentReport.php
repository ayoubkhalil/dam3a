<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IncidentReport extends Model
{
    protected $fillable = [
        'analysis_id', 'report_number', 'summary', 'severity',
        'risks', 'recommendations', 'pdf_path',
    ];

    protected $casts = [
        'risks' => 'array',
        'recommendations' => 'array',
    ];

    public function analysis(): BelongsTo
    {
        return $this->belongsTo(BullyingAnalysis::class, 'analysis_id');
    }
}
