<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Community extends Model
{
    protected $fillable = ['name', 'description', 'moderation_mode', 'created_by_user_id'];

    public const MODERATION_AI_ONLY = 'ai_only';
    public const MODERATION_HUMAN_AI = 'human_ai';
    public const MODERATION_PEER_LED = 'peer_led';

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'community_members')
            ->withPivot('role')
            ->withTimestamps();
    }

    public function communityMembers(): HasMany
    {
        return $this->hasMany(CommunityMember::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(CommunityMessage::class);
    }
}
