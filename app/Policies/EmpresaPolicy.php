<?php

namespace App\Policies;

use App\User;
use App\Empresa;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmpresaPolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        return (boolean)$user->hasRole('admin');
    }

    public function userIndex(User $user)
    {
        return (boolean)$user->hasRole('user');
    }

    public function userCadastros(User $user)
    {
        return (boolean)$user->hasRole('user');
    }

    public function userProdutos(User $user)
    {
        return (boolean)$user->hasRole('user');
    }

    /**
     * Determine whether the user can view the empresa.
     *
     * @param  \App\User  $user
     * @param  \App\Empresa  $empresa
     * @return mixed
     */
    public function view(User $user, Empresa $empresa)
    {
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can create empresas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can update the empresa.
     *
     * @param  \App\User  $user
     * @param  \App\Empresa  $empresa
     * @return mixed
     */
    public function update(User $user, Empresa $empresa)
    {
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can delete the empresa.
     *
     * @param  \App\User  $user
     * @param  \App\Empresa  $empresa
     * @return mixed
     */
    public function delete(User $user, Empresa $empresa)
    {
        return $user->hasRole('Admin');
    }
}
