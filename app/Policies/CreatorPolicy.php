<?php

namespace App\Policies;

use App\Models\Creator;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CreatorPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Creator $creator): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Creator $creator): bool
    {
        return $creator->email_verified_at != null;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Creator $creator): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Creator $creator): bool
    {
        return auth('creator')->user()->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Creator $creator): bool
    {
        return auth('creator')->user()->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Creator $creator): bool
    {
        return false;
    }

    public function search(Creator $creator): bool
    {
        // Only verified creators can search
        return $creator->email_verified_at !== null || auth('creator')->user()->role === 'admin';
    }
}
