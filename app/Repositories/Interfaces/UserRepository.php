<?php

namespace App\Repositories\Interfaces;


use App\Models\User;

interface UserRepository
{
    /**
     * @param User $user
     * @return mixed
     */
    public function getUser(User $user);

}
