<?php

namespace App\Policies;

use App\Apartment;
use App\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApartmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
      
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Apartment  $apartment
     * @return mixed
     */
    public function view(User $user, Apartment $apartment)
    {
      if ($user->id == $apartment->user_id) {
        return true;
      } else {
        return false;
      }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
      if ($user->id == $apartment->user_id) {
        return true;
      } else {
        return false;
      }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Apartment  $apartment
     * @return mixed
     */
    public function update(User $user, Apartment $apartment)
    {
      if ($user->id == $apartment->user_id) {
        return true;
      } else {
        return false;
      }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Apartment  $apartment
     * @return mixed
     */
    public function delete(User $user, Apartment $apartment)
    {
      if ($user->id == $apartment->user_id) {
        return true;
      } else {
        return false;
      }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Apartment  $apartment
     * @return mixed
     */
    public function restore(User $user, Apartment $apartment)
    {
      if ($user->id == $apartment->user_id) {
        return true;
      } else {
        return false;
      }
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Apartment  $apartment
     * @return mixed
     */
    public function forceDelete(User $user, Apartment $apartment)
    {
      if ($user->id == $apartment->user_id) {
        return true;
      } else {
        return false;
      }
    }
}
