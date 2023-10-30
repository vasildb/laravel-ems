<?php

namespace App\Http\Controllers\Api;

use App\Models\TalkProposal;
use App\Http\Controllers\Controller;
use App\Models\Tag;

class StatisticsController extends Controller
{
    /**
     * Show proposals statistics
     */
    public function index()
    {
        $proposalCount = TalkProposal::count();
        $proposalAverageRating = TalkProposal::select('talk_proposals.id AS proposal_id', 'talk_proposals.title', \DB::raw('AVG(rating) AS avg_rating'))
            ->join('reviews', 'talk_proposals.id', '=', 'reviews.talk_proposal_id')
            ->groupBy('talk_proposals.id', 'talk_proposals.title')
            ->get();
        $numberOfProposalsPerTag = Tag::select('tags.title', \DB::raw('COUNT(talk_proposal_tags.id) as count'))
            ->leftJoin('talk_proposal_tags', 'tags.id', '=', 'talk_proposal_tags.tag_id')
            ->leftJoin('talk_proposals', 'talk_proposals.id', '=', 'talk_proposal_tags.talk_proposal_id')
            ->groupBy('tags.id', 'tags.title')
            ->orderBy('tags.id', 'ASC')
            ->get();

        return response()->json([
            'proposals_count' => $proposalCount,
            'proposal_average_rating' => $proposalAverageRating,
            'proposal_count_per_tag' => $numberOfProposalsPerTag
        ]);
    }
}
