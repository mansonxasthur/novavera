<?php

namespace App\Policies;

use App\Admin;
use App\SliderImage;
use Illuminate\Auth\Access\HandlesAuthorization;

class SliderImagePolicy
{
    use HandlesAuthorization;

    public function before(Admin $user)
    {
        if ($user->isSuper() || $user->isAdmin())
            return true;
    }

    /**
     * Determine whether the user can view the slider image.
     *
     * @param  \App\Admin  $user
     * @param  \App\SliderImage  $sliderImage
     * @return mixed
     */
    public function view(Admin $user, SliderImage $sliderImage)
    {
        //
    }

    /**
     * Determine whether the user can create slider images.
     *
     * @param  \App\Admin  $user
     * @return mixed
     */
    public function create(Admin $user)
    {
        //
    }

    /**
     * Determine whether the user can update the slider image.
     *
     * @param  \App\Admin  $user
     * @param  \App\SliderImage  $sliderImage
     * @return mixed
     */
    public function update(Admin $user, SliderImage $sliderImage)
    {
        //
    }

    /**
     * Determine whether the user can delete the slider image.
     *
     * @param  \App\Admin  $user
     * @param  \App\SliderImage  $sliderImage
     * @return mixed
     */
    public function delete(Admin $user, SliderImage $sliderImage)
    {
        //
    }

    /**
     * Determine whether the user can restore the slider image.
     *
     * @param  \App\Admin  $user
     * @param  \App\SliderImage  $sliderImage
     * @return mixed
     */
    public function restore(Admin $user, SliderImage $sliderImage)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the slider image.
     *
     * @param  \App\Admin  $user
     * @param  \App\SliderImage  $sliderImage
     * @return mixed
     */
    public function forceDelete(Admin $user, SliderImage $sliderImage)
    {
        //
    }
}
