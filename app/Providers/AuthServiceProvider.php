<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        App\Models\Empresa::class => App\Models\Policies\EmpresaPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Gate::resource('manage-empresas', 'App\Policies\EmpresaPolicy');

        Gate::define('manage-empresas', 'App\Policies\EmpresaPolicy@index');
        Gate::define('manage-empresa', 'App\Policies\EmpresaPolicy@userIndex');
        Gate::define('manage-cadastros', 'App\Policies\EmpresaPolicy@userCadastros');
        Gate::define('manage-produtos', 'App\Policies\EmpresaPolicy@userProdutos');





    }
}
