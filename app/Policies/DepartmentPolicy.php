<?php

namespace App\Policies;

use App\Admin;
use App\Department;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartmentPolicy
{
    use HandlesAuthorization;

    public function before(Admin $user)
    {
        if ($user->isSuper() || $user->isAdmin())
            return true;
    }

    /**
     * Determine whether the user can view the department.
     *
     * @param  \App\Admin  $user
     * @param  \App\Department  $department
     * @return mixed
     */
    public function view(Admin $user, Department $department)
    {
        //
    }

    /**
     * Determine whether the user can create departments.
     *
     * @param  \App\Admin  $user
     * @return mixed
     */
    public function create(Admin $user)
    {
        //
    }

    /**
     * Determine whether the user can update the department.
     *
     * @param  \App\Admin  $user
     * @param  \App\Department  $department
     * @return mixed
     */
    public function update(Admin $user, Department $department)
    {
        //
    }

    /**
     * Determine whether the user can delete the department.
     *
     * @param  \App\Admin  $user
     * @param  \App\Department  $department
     * @return mixed
     */
    public function delete(Admin $user, Department $department)
    {
        //
    }

    /**
     * Determine whether the user can restore the department.
     *
     * @param  \App\Admin  $user
     * @param  \App\Department  $department
     * @return mixed
     */
    public function restore(Admin $user, Department $department)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the department.
     *
     * @param  \App\Admin  $user
     * @param  \App\Department  $department
     * @return mixed
     */
    public function forceDelete(Admin $user, Department $department)
    {
        //
    }
}
