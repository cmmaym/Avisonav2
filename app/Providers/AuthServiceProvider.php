<?php

namespace AvisoNavAPI\Providers;

use Carbon\Carbon;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'AvisoNavAPI\Model' => 'AvisoNavAPI\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
        Passport::tokensExpireIn(Carbon::now()->addMinutes(30));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(1));
        
        Passport::tokensCan([
            'create' => 'Crear',
            'read'   => 'Leer',
            'delete' => 'Borrar',
            'update' => 'Actualizar',
            'user'   => 'Crear, leer, borrar, actualizar usuarios',
        ]);
    }
}
