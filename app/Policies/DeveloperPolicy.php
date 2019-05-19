<?php

namespace App\Policies;

use App\Admin;
use App\Developer;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeveloperPolicy
{
    use HandlesAuthorization;


    public function before(Admin $user)
    {
        if ($user->isSuper() || $user->isAdmin())
            return true;
    }

    /**
     * Determine whether the user can view the developer.
     *
     * @param  \App\Admin  $user
     * @param  \App\Developer  $developer
     * @return mixed
     */
    public function view(Admin $user, Developer $developer)
    {
        //
    }

    /**
     * Determine whether the user can create developers.
     *
     * @param  \App\Admin  $user
     * @return mixed
     */
    public function create(Admin $user)
    {
        //
    }

    /**
     * Determine whether the user can update the developer.
     *
     * @param  \App\Admin  $user
     * @param  \App\Developer  $developer
     * @return mixed
     */
    public function update(Admin $user, Developer $developer)
    {
        //
    }

    /**
     * Determine whether the user can delete the developer.
     *
     * @param  \App\Admin  $user
     * @param  \App\Developer  $developer
     * @return mixed
     */
    public function delete(Admin $user, Developer $developer)
    {
        //
    }

    /**
     * Determine whether the user can restore the developer.
     *
     * @param  \App\Admin  $user
     * @param  \App\Developer  $developer
     * @return mixed
     */
    public function restore(Admin $user, Developer $developer)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the developer.
     *
     * @param  \App\Admin  $user
     * @param  \App\Developer  $developer
     * @return mixed
     */
    public function forceDelete(Admin $user, Developer $developer)
    {
        //
    }
}
