<?php

namespace App\Policies;

use App\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Only super admins are authorized
     *
     * @param Admin $user
     *
     * @return bool
     */
    public function before(Admin $user, $ability)
    {
        if ($user->isSuper()) return true;
    }

    public function create(Admin $user){
        //
    }
}
