<?php

namespace App\Policies;

use App\Admin;
use App\Applicant;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicantPolicy
{
    use HandlesAuthorization;

    public function before(Admin $user)
    {
        return $user->isSuper() || $user->isAdmin();
    }

    /**
     * Determine whether the user can view the applicant.
     *
     * @param  \App\Admin  $user
     * @param  \App\Applicant  $applicant
     * @return mixed
     */
    public function view(Admin $user, Applicant $applicant)
    {
        //
    }
}
