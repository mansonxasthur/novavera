<?php

namespace App\Policies;

use App\Admin;
use App\PropertyRequest;
use Illuminate\Auth\Access\HandlesAuthorization;

class PropertyRequestPolicy
{
    use HandlesAuthorization;

    public function before(Admin $user)
    {
        return $user->isSuper() || $user->isAdmin();
    }

    /**
     * Determine whether the user can view the property request.
     *
     * @param  \App\Admin  $user
     * @param  \App\PropertyRequest  $propertyRequest
     * @return mixed
     */
    public function view(Admin $user, PropertyRequest $propertyRequest)
    {
        //
    }
}
