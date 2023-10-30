<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Http\Controllers\Controller;
use App\Models\User;

class ReviewerController extends Controller
{
    /**
     * List reviewers
     */
    public function index()
    {
        $reviewers = User::where('type', 'reviewer')->get()->map->only(['id', 'name', 'email']);
        return response()->json($reviewers);
    }

    /**
     * List reviews by talk proposal
     */
    public function reviews(Request $request)
    {
        $reviews = Review::where('talk_proposal_id', $request->input('talk_proposal_id'))->get()->map->makeHidden('talk_proposal_id');
        return response()->json($reviews);
    }
}
