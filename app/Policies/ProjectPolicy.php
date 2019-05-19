<?php

namespace App\Policies;

use App\Admin;
use App\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function before(Admin $user)
    {
        if ($user->isSuper() || $user->isAdmin())
            return true;
    }

    /**
     * Determine whether the user can view the project.
     *
     * @param  \App\Admin  $user
     * @param  \App\Project  $project
     * @return mixed
     */
    public function view(Admin $user, Project $project)
    {
        //
    }

    /**
     * Determine whether the user can create projects.
     *
     * @param  \App\Admin  $user
     * @return mixed
     */
    public function create(Admin $user)
    {
        //
    }

    /**
     * Determine whether the user can update the project.
     *
     * @param  \App\Admin  $user
     * @param  \App\Project  $project
     * @return mixed
     */
    public function update(Admin $user, Project $project)
    {
        return $user->isSeo();
    }

    /**
     * Determine whether the user can delete the project.
     *
     * @param  \App\Admin  $user
     * @param  \App\Project  $project
     * @return mixed
     */
    public function delete(Admin $user, Project $project)
    {
        //
    }

    /**
     * Determine whether the user can restore the project.
     *
     * @param  \App\Admin  $user
     * @param  \App\Project  $project
     * @return mixed
     */
    public function restore(Admin $user, Project $project)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the project.
     *
     * @param  \App\Admin  $user
     * @param  \App\Project  $project
     * @return mixed
     */
    public function forceDelete(Admin $user, Project $project)
    {
        //
    }
}
