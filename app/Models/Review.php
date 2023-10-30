<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\TalkProposal;

class Review extends Model
{
    use HasFactory;

    public function talkProposal(): BelongsTo
    {
        return $this->belongsTo(TalkProposal::class);
    }
}
