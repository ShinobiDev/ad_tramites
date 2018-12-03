<?php

namespace App\Policies;

use App\User;
use App\Anuncio;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnuncioPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the anuncio.
     * esta politica solo se agregara cuando vaya a ver solo mis anuncios
     *
     * @param  \App\User  $user
     * @param  \App\Anuncio  $anuncio
     * @return mixed
     */
    public function view(User $user, Anuncio $anuncio)
    {
        //
        return $user->id === $anuncio->id_user;
    }

    /**
     * Determine whether the user can create anuncios.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the anuncio.
     *
     * @param  \App\User  $user
     * @param  \App\Anuncio  $anuncio
     * @return mixed
     */
    public function update(User $user, Anuncio $anuncio)
    {
        //
        return $user->id === $anuncio->id_user;
    }

    /**
     * Determine whether the user can delete the anuncio.
     *
     * @param  \App\User  $user
     * @param  \App\Anuncio  $anuncio
     * @return mixed
     */
    public function delete(User $user, Anuncio $anuncio)
    {
        //
        return $user->id === $anuncio->id_user;
    }
}
