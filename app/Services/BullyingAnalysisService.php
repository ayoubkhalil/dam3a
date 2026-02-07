<?php

namespace App\Services;

use App\Contracts\AiChatService;
use App\Models\BullyingAnalysis;
use Illuminate\Support\Facades\Auth;

class BullyingAnalysisService
{
    public function __construct(
        protected AiChatService $ai
    ) {}

    /**
     * Analyze incident text and store result.
     */
    public function analyze(string $incidentText, ?string $alias = null, ?int $age = null, ?string $city = null, ?string $school = null): BullyingAnalysis
    {
        $result = $this->ai->analyzeBullying($incidentText);

        $userId = Auth::id();
        $sessionId = $userId ? null : session()->getId();

        return BullyingAnalysis::create([
            'user_id' => $userId,
            'session_id' => $sessionId,
            'alias' => $alias,
            'age' => $age,
            'city' => $city,
            'school' => $school,
            'incident_text' => $incidentText,
            'type' => $result['type'] ?? null,
            'severity' => $result['severity'] ?? null,
            'risk_indicators' => $result['risk_indicators'] ?? null,
            'recommended_action' => $result['recommended_action'] ?? null,
            'raw_response' => $result,
        ]);
    }
}
