<?php

namespace App\Policies;

use App\Admin;
use App\Page;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
{
    use HandlesAuthorization;

    public function before(Admin $user)
    {
        if ($user->isSuper() || $user->isAdmin())
            return true;
    }

    /**
     * Determine whether the user can view the page.
     *
     * @param  \App\Admin  $user
     * @param  \App\Page  $page
     * @return mixed
     */
    public function view(Admin $user, Page $page)
    {
        //
    }

    /**
     * Determine whether the user can create pages.
     *
     * @param  \App\Admin  $user
     * @return mixed
     */
    public function create(Admin $user)
    {
        //
    }

    /**
     * Determine whether the user can update the page.
     *
     * @param  \App\Admin  $user
     * @param  \App\Page  $page
     * @return mixed
     */
    public function update(Admin $user, Page $page)
    {
        return $user->isSeo();
    }

    /**
     * Determine whether the user can delete the page.
     *
     * @param  \App\Admin  $user
     * @param  \App\Page  $page
     * @return mixed
     */
    public function delete(Admin $user, Page $page)
    {
        //
    }

    /**
     * Determine whether the user can restore the page.
     *
     * @param  \App\Admin  $user
     * @param  \App\Page  $page
     * @return mixed
     */
    public function restore(Admin $user, Page $page)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the page.
     *
     * @param  \App\Admin  $user
     * @param  \App\Page  $page
     * @return mixed
     */
    public function forceDelete(Admin $user, Page $page)
    {
        //
    }
}
