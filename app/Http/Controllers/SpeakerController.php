<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\AddTalkRequest;
use App\Models\TalkProposal;
use App\Models\Tag;

class SpeakerController extends Controller
{
    /**
     * Show the speaker dashboard
     */
    public function dashboard(Request $request): View
    {
        $tps = TalkProposal::where('speaker_id', $request->user()->speaker->id)->get();
        return view('speaker.dashboard', ['talkProposals' => $tps]);
    }

    /**
     * Show new talk proposal form
     */
    public function showNewTalkProposalForm(): View
    {
        $tags = Tag::all();
        return view('speaker.add-talk-proposal', ['tags' => $tags]);
    }

    /**
     * Add talk proposal
     */
    public function addTalkProposal(AddTalkRequest $request): View
    {
        $validated = $request->validated();

        $tp = new TalkProposal;
        $tp->speaker_id = $request->user()->speaker->id;
        $tp->title = $validated['title'];
        $tp->save();

        $tp->tags()->sync($validated['tags']);

        $request->file('file')->store('talk-proposals/' . $tp->id . '.pdf');

        $tags = Tag::all();
        return view('speaker.add-talk-proposal', ['tags' => $tags])
            ->with('success', 'Talk request successfully added!');
    }
}
