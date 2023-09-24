<?php

namespace App\Policies;

use App\Models\Gig;
use App\Models\User;

class GigPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user, Gig $gig)
    {
        return $user->id === $gig->freelancer_id;
    }
}
