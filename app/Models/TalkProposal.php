<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Speaker;
use App\Models\Review;
use App\Models\Tag;
use App\Models\History;

class TalkProposal extends Model
{
    use HasFactory;

    public function speaker(): BelongsTo
    {
        return $this->belongsTo(Speaker::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'talk_proposal_tags');
    }

    protected static function booted(): void
    {
        static::updating(function ($tp) {
            History::log('TalkProposal', $tp);
        });
    }
}
