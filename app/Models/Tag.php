<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\TalkProposal;

class Tag extends Model
{
    use HasFactory;

    public function talkProposal(): BelongsToMany
    {
        return $this->belongsToMany(TalkProposal::class, 'talk_proposal_tags');
    }
}
