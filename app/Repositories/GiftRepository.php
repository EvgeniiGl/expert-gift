<?php

namespace App\Repositories;

use App\Models\Gift;
use App\Repositories\Interfaces\GiftRepository as GiftRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class GiftRepository implements GiftRepositoryInterface
{

    private $count = 15;

    /**
     * @param int $userId
     * @return Gift[] | Collection
     */
    public function getNewGifts(int $userId)
    {
        $gifts = Gift::leftJoin('gift_user', function ($join) {
            $join->on('gifts.id', '=', 'gift_user.gift_id');
        })
            ->where('title',
                '!=',
                null)
            ->whereNotIn('id', function ($query) use ($userId) {
                $query->select('gift_id')->from('gift_user')->where('user_id', $userId);
            })
            ->orWhere([['mark',
                        null],
                       ['title',
                        '!=',
                        null]])
            ->limit($this->count)
            ->get()
            ->toArray();
        if ($this->count > count($gifts)) return [];
        return $gifts;
    }

    public function saveMarks($userId, $data)
    {
        foreach ($data as $k => $gift) {
            $item['gift_id']    = $gift['id'];
            $item['mark']       = $gift['mark'];
            $item['user_id']    = $userId;
            $item['created_at'] = Carbon::now();
            DB::table('gift_user')->updateOrInsert(
                [
                    'user_id' => $item['user_id'],
                    'gift_id' => $item['gift_id']
                ], $item);
        }
    }

}
