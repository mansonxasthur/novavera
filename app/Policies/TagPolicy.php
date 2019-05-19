<?php

namespace App\Policies;

use App\Admin;
use App\Tag;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
{
    use HandlesAuthorization;

    public function before(Admin $user)
    {
        if ($user->isSuper() || $user->isAdmin())
            return true;
    }

    /**
     * Determine whether the user can view the tag.
     *
     * @param  \App\Admin  $user
     * @param  \App\Tag  $tag
     * @return mixed
     */
    public function view(Admin $user, Tag $tag)
    {
        //
    }

    /**
     * Determine whether the user can create tags.
     *
     * @param  \App\Admin  $user
     * @return mixed
     */
    public function create(Admin $user)
    {
        //
    }

    /**
     * Determine whether the user can update the tag.
     *
     * @param  \App\Admin  $user
     * @param  \App\Tag  $tag
     * @return mixed
     */
    public function update(Admin $user, Tag $tag)
    {
        //
    }

    /**
     * Determine whether the user can delete the tag.
     *
     * @param  \App\Admin  $user
     * @param  \App\Tag  $tag
     * @return mixed
     */
    public function delete(Admin $user, Tag $tag)
    {
        //
    }

    /**
     * Determine whether the user can restore the tag.
     *
     * @param  \App\Admin  $user
     * @param  \App\Tag  $tag
     * @return mixed
     */
    public function restore(Admin $user, Tag $tag)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the tag.
     *
     * @param  \App\Admin  $user
     * @param  \App\Tag  $tag
     * @return mixed
     */
    public function forceDelete(Admin $user, Tag $tag)
    {
        //
    }
}
