<?php

namespace App\Policies;

use App\Models\User;
use App\User001;
use Illuminate\Auth\Access\HandlesAuthorization;

class User02Policy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the user001.
     *
     * @param  \App\Models\User  $user
     * @param  \App\User001  $user001
     * @return mixed
     */
    public function view(User $user, User001 $user001)
    {
        //
    }

    /**
     * Determine whether the user can create user001s.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the user001.
     *
     * @param  \App\Models\User  $user
     * @param  \App\User001  $user001
     * @return mixed
     */
    public function update(User $user, User001 $user001)
    {
        //
    }

    /**
     * Determine whether the user can delete the user001.
     *
     * @param  \App\Models\User  $user
     * @param  \App\User001  $user001
     * @return mixed
     */
    public function delete(User $user, User001 $user001)
    {
        //
    }

    /**
     * Determine whether the user can restore the user001.
     *
     * @param  \App\Models\User  $user
     * @param  \App\User001  $user001
     * @return mixed
     */
    public function restore(User $user, User001 $user001)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the user001.
     *
     * @param  \App\Models\User  $user
     * @param  \App\User001  $user001
     * @return mixed
     */
    public function forceDelete(User $user, User001 $user001)
    {
        //
    }
}
