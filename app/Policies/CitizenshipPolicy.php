<?php

namespace App\Policies;

use App\Admin;
use App\Citizenship;
use Illuminate\Auth\Access\HandlesAuthorization;

class CitizenshipPolicy
{
    use HandlesAuthorization;

    public function before(Admin $user)
    {
        if ($user->isSuper() || $user->isAdmin())
            return true;
    }

    /**
     * Determine whether the user can view the citizenship.
     *
     * @param  \App\Admin  $user
     * @param  \App\Citizenship  $citizenship
     * @return mixed
     */
    public function view(Admin $user, Citizenship $citizenship)
    {
        //
    }

    /**
     * Determine whether the user can create citizenships.
     *
     * @param  \App\Admin  $user
     * @return mixed
     */
    public function create(Admin $user)
    {
        //
    }

    /**
     * Determine whether the user can update the citizenship.
     *
     * @param  \App\Admin  $user
     * @param  \App\Citizenship  $citizenship
     * @return mixed
     */
    public function update(Admin $user, Citizenship $citizenship)
    {
        return $user->isSeo();
    }

    /**
     * Determine whether the user can delete the citizenship.
     *
     * @param  \App\Admin  $user
     * @param  \App\Citizenship  $citizenship
     * @return mixed
     */
    public function delete(Admin $user, Citizenship $citizenship)
    {
        //
    }

    /**
     * Determine whether the user can restore the citizenship.
     *
     * @param  \App\Admin  $user
     * @param  \App\Citizenship  $citizenship
     * @return mixed
     */
    public function restore(Admin $user, Citizenship $citizenship)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the citizenship.
     *
     * @param  \App\Admin  $user
     * @param  \App\Citizenship  $citizenship
     * @return mixed
     */
    public function forceDelete(Admin $user, Citizenship $citizenship)
    {
        //
    }
}
