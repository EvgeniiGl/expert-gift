<?php

namespace App\Http\Controllers;


use App\Repositories\Interfaces\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        return view('index');
    }

    public function user(Request $request)
    {
        $user = $request->user;
//add score per visit and save cache
        $cacheTime     = Carbon::now()->startOfDay()->addDay()->timestamp - time();
        $keyVisitCache = "_visit_score_$user->id";
        if (empty(Cache::get($keyVisitCache))) {
            $user->update(['score' => $user->score + 1]);
            Cache::put($keyVisitCache, true, $cacheTime);
        }
        $user = $this->userRepository->getUser($user);
        return successResponse(['data' => $user]);
    }

    public function ratingUsers(Request $request)
    {
        $user  = $request->user;
        $users = $this->userRepository->ratingUsers($user);
        return successResponse(['data' => $users]);
    }

}
