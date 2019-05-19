<?php

namespace App\Policies;

use App\Admin;
use App\Slider;
use Illuminate\Auth\Access\HandlesAuthorization;

class SliderPolicy
{
    use HandlesAuthorization;

    public function before(Admin $user)
    {
        if ($user->isSuper() || $user->isAdmin())
            return true;
    }

    /**
     * Determine whether the user can view the slider.
     *
     * @param  \App\Admin  $user
     * @param  \App\Slider  $slider
     * @return mixed
     */
    public function view(Admin $user, Slider $slider)
    {
        //
    }

    /**
     * Determine whether the user can create sliders.
     *
     * @param  \App\Admin  $user
     * @return mixed
     */
    public function create(Admin $user)
    {
        //
    }

    /**
     * Determine whether the user can update the slider.
     *
     * @param  \App\Admin  $user
     * @param  \App\Slider  $slider
     * @return mixed
     */
    public function update(Admin $user, Slider $slider)
    {
        //
    }

    /**
     * Determine whether the user can delete the slider.
     *
     * @param  \App\Admin  $user
     * @param  \App\Slider  $slider
     * @return mixed
     */
    public function delete(Admin $user, Slider $slider)
    {
        //
    }

    /**
     * Determine whether the user can restore the slider.
     *
     * @param  \App\Admin  $user
     * @param  \App\Slider  $slider
     * @return mixed
     */
    public function restore(Admin $user, Slider $slider)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the slider.
     *
     * @param  \App\Admin  $user
     * @param  \App\Slider  $slider
     * @return mixed
     */
    public function forceDelete(Admin $user, Slider $slider)
    {
        //
    }
}
