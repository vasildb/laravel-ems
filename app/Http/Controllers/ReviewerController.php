<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\AddReviewRequest;
use App\Models\TalkProposal;
use App\Models\Review;
use Illuminate\Support\Facades\Mail;
use App\Mail\TalkProposalReviewed;

class ReviewerController extends Controller
{
    /**
     * Show the reviewer dashboard
     */
    public function dashboard(Request $request): View
    {
        $q = $request->input('q') ?? '';
        list($speaker, $tags) = $this->getFilters($q);

        $tps = TalkProposal::select();

        if ($speaker) {
            $tps->join('speakers', 'speakers.id', '=', 'talk_proposals.speaker_id')
                ->join('users', 'users.id', '=', 'speakers.user_id')
                ->where('users.name', 'LIKE', '%' . $speaker . '%');
        }

        if ($tags) {
            $tps->join('talk_proposal_tags', 'talk_proposals.id', '=', 'talk_proposal_tags.talk_proposal_id')
                ->join('tags', 'tags.id', '=', 'talk_proposal_tags.tag_id');
            foreach ($tags as $tag) {
                $tps->where('tags.title', 'LIKE', '%' . $tag . '%');
            }
        }

        $tps = $tps->orderBy('talk_proposals.id', 'desc')->get();
        return view('reviewer.dashboard', [
            'talkProposals' => $tps,
            'q' => $q
        ]);
    }

    /**
     * Show review form
     */
    public function showReviewForm(TalkProposal $talkProposal): View
    {
        return view('reviewer.review', ['talkProposal' => $talkProposal]);
    }

    /**
     * Review talk proposal
     */
    public function addReview(TalkProposal $talkProposal, AddReviewRequest $request): View
    {
        $validated = $request->validated();

        $r = new Review;
        $r->comments = $validated['comment'];
        $r->rating = $validated['rating'];
        $r->talk_proposal_id = $talkProposal->id;
        $r->user_id = $request->user()->id;
        $r->save();

        Mail::to($talkProposal->speaker->user)->send(new TalkProposalReviewed($talkProposal));

        return view('reviewer.review', ['talkProposal' => $talkProposal])->with('success', 'Review successfully added!');
    }

    private function getFilters(string $q)
    {
        $speaker = '';
        $tags = [];

        $q = explode(' ', $q);
        foreach ($q as $qq) {
            $qq = explode(':', $qq);
            if (isset($qq[0]) && isset($qq[1])) {
                $qq[1] = strtolower($qq[1]);

                if ($qq[0] === 'speaker')
                    $speaker = $qq[1];
                else if ($qq[0] === 'tag') {
                    $tags = explode(',', $qq[1]);
                }
            }
        }

        return [$speaker, $tags];
    }
}
