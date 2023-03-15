<?php

namespace App\Policies;

use App\Models\Info;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InfoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Info $info)
    {
        return $user->hasRole('super admin');
    }
}
