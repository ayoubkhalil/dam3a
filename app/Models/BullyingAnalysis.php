<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BullyingAnalysis extends Model
{
    protected $fillable = [
        'user_id', 'session_id', 'alias', 'age', 'city', 'school',
        'incident_text', 'type', 'severity', 'risk_indicators',
        'recommended_action', 'raw_response',
    ];

    protected $casts = [
        'risk_indicators' => 'array',
        'raw_response' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function incidentReport(): HasOne
    {
        return $this->hasOne(IncidentReport::class, 'analysis_id');
    }
}
