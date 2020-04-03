<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\GiftRepository;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    private $giftRepository;

    public function __construct(GiftRepository $giftRepository)
    {
        $this->giftRepository = $giftRepository;
    }

    /**
     * Возвращает идеи оцененные пользователем
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function gifts(Request $request)
    {
        $user  = $request->user;
        $gifts = $user->gifts;
        //TODO rewrite with response helper
        return response()->json($gifts);
    }

    public function giftsNew(Request $request)
    {
        $user   = $request->user;
        $userId = $user->id;
        $gifts  = $this->giftRepository->getNewGifts($userId);
        return successResponse(['data' => $gifts]);
    }

    public function saveMarks(Request $request)
    {
        $marks  = $request->all();
        $user   = $request->user;
        $userId = $user->id;
        $this->giftRepository->saveMarks($userId, $marks);
        $totalScore = $user->total_gifts + $user->score;
        return successResponse(['data' => $totalScore]);
    }

}
