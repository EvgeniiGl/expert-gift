<?php

namespace App\Http\Controllers;

use App\Models\Repost;
use Illuminate\Http\Request;

class RepostController extends Controller
{

    private $scoreForRepost = 5;

    public function repost(Request $request)
    {
        $user            = $request->user;
        $repost          = new Repost();
        $repost->gift_id = $request->id;
        $repost->user_id = $user->id;
        $score           = $user->score;
        $repost->save();
        $user->update(['score' => $score + $this->scoreForRepost]);
        $totalScore = $user->total_gifts + $score;
        return successResponse(['data' => $totalScore]);
    }
}
