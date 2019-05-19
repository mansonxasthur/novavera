<?php

namespace App\Policies;

use App\Admin;
use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function before(Admin $user)
    {
        if ($user->isSuper() || $user->isAdmin())
            return true;
    }

    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\Admin  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function view(Admin $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\Admin  $user
     * @return mixed
     */
    public function create(Admin $user)
    {
        //
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\Admin  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function update(Admin $user, Post $post)
    {
        return $user->isSeo();
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\Admin  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function delete(Admin $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can restore the post.
     *
     * @param  \App\Admin  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function restore(Admin $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the post.
     *
     * @param  \App\Admin  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function forceDelete(Admin $user, Post $post)
    {
        //
    }
}
