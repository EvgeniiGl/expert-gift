<?php

namespace App\Repositories;

use App\Models\Stage;
use App\Models\User;
use App\Repositories\Interfaces\UserRepository as UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function getUser(User $user)
    {
        //TODO rewrite to one query
        $totalScore           = $user->total_gifts + $user->score;
        $stage                = Stage::where('score', '>=', $totalScore)->orderBy('score', 'ASC')->first();
        $user->stage          = $stage;
        $user->stage['score'] = $totalScore;
        $user->score          = $totalScore;
        $positionTop          = User::where('score', '>=', $totalScore)->count() + 1;
        $user['top']          = $positionTop;
        return $user->toArray();
    }

    public function ratingUsers(User $user)
    {
        $users = User::withCount('gifts')->orderBy('score', 'desc')->paginate(30);
        return successResponse(['data' => $users]);
    }
}
