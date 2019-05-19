<?php

namespace App\Policies;

use App\Admin;
use App\Location;
use Illuminate\Auth\Access\HandlesAuthorization;

class LocationPolicy
{
    use HandlesAuthorization;

    public function before(Admin $user)
    {
        if ($user->isSuper() || $user->isAdmin())
            return true;
    }

    /**
     * Determine whether the user can view the location.
     *
     * @param  \App\Admin  $user
     * @param  \App\Location  $location
     * @return mixed
     */
    public function view(Admin $user, Location $location)
    {
        //
    }

    /**
     * Determine whether the user can create locations.
     *
     * @param  \App\Admin  $user
     * @return mixed
     */
    public function create(Admin $user)
    {
        //
    }

    /**
     * Determine whether the user can update the location.
     *
     * @param  \App\Admin  $user
     * @param  \App\Location  $location
     * @return mixed
     */
    public function update(Admin $user, Location $location)
    {
        //
    }

    /**
     * Determine whether the user can delete the location.
     *
     * @param  \App\Admin  $user
     * @param  \App\Location  $location
     * @return mixed
     */
    public function delete(Admin $user, Location $location)
    {
        //
    }

    /**
     * Determine whether the user can restore the location.
     *
     * @param  \App\Admin  $user
     * @param  \App\Location  $location
     * @return mixed
     */
    public function restore(Admin $user, Location $location)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the location.
     *
     * @param  \App\Admin  $user
     * @param  \App\Location  $location
     * @return mixed
     */
    public function forceDelete(Admin $user, Location $location)
    {
        //
    }
}
