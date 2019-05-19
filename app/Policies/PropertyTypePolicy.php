<?php

namespace App\Policies;

use App\Admin;
use App\PropertyType;
use Illuminate\Auth\Access\HandlesAuthorization;

class PropertyTypePolicy
{
    use HandlesAuthorization;

    public function before(Admin $user)
    {
        if ($user->isSuper() || $user->isAdmin())
            return true;
    }

    /**
     * Determine whether the user can view the property type.
     *
     * @param  \App\Admin  $user
     * @param  \App\PropertyType  $propertyType
     * @return mixed
     */
    public function view(Admin $user, PropertyType $propertyType)
    {
        //
    }

    /**
     * Determine whether the user can create property types.
     *
     * @param  \App\Admin  $user
     * @return mixed
     */
    public function create(Admin $user)
    {
        //
    }

    /**
     * Determine whether the user can update the property type.
     *
     * @param  \App\Admin  $user
     * @param  \App\PropertyType  $propertyType
     * @return mixed
     */
    public function update(Admin $user, PropertyType $propertyType)
    {
        //
    }

    /**
     * Determine whether the user can delete the property type.
     *
     * @param  \App\Admin  $user
     * @param  \App\PropertyType  $propertyType
     * @return mixed
     */
    public function delete(Admin $user, PropertyType $propertyType)
    {
        //
    }

    /**
     * Determine whether the user can restore the property type.
     *
     * @param  \App\Admin  $user
     * @param  \App\PropertyType  $propertyType
     * @return mixed
     */
    public function restore(Admin $user, PropertyType $propertyType)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the property type.
     *
     * @param  \App\Admin  $user
     * @param  \App\PropertyType  $propertyType
     * @return mixed
     */
    public function forceDelete(Admin $user, PropertyType $propertyType)
    {
        //
    }
}
