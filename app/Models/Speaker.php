<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\User;
use App\Models\TalkProposal;

class Speaker extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function talkProposal(): HasOne
    {
        return $this->hasOne(TalkProposal::class);
    }

    protected static function booted(): void
    {
        static::updating(function ($s) {
            History::log('Speaker', $s);
        });
    }
}
