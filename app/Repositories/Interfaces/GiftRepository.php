<?php

namespace App\Repositories\Interfaces;


interface GiftRepository
{

    /**
     * @param int $user_id
     * @return mixed
     */
    public function getNewGifts(int $user_id);

    /**
     * @param $userId int
     * @param $data array
     * @return mixed
     */
    public function saveMarks($userId, $data);

}
