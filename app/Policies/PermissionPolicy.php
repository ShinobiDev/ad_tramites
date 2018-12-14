<?php

namespace App\Policies;

use App\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    //politiza si es administrador
    public function before($user){

          if ($user->hasRole('Admin'))
          {

              return true;
          }

      }
    /**
     * Determine whether the user can view the permission.
     *
     * @param  \App\User  $user
     * @param  \App\Permission  $permission
     * @return mixed
     */
    public function view(User $user, Permission $permission)
    {
        //
        return $user->hasRole('Admin')|| $user->hasPermissionTo('Ver Permisos');
    }

    /**
     * Determine whether the user can create permissions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the permission.
     *
     * @param  \App\User  $user
     * @param  \App\Permission  $permission
     * @return mixed
     */
    public function update(User $user, Permission $permission)
    {
        //
        return $user->hasRole('Admin') || $user->hasPermissionTo('Editar Permisos');
    }

    /**
     * Determine whether the user can delete the permission.
     *
     * @param  \App\User  $user
     * @param  \App\Permission  $permission
     * @return mixed
     */
    public function delete(User $user, Permission $permission)
    {
        //
    }
}
