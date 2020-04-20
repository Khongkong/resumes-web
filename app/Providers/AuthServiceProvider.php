<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Enums\UserType;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('edit-or-delete-resume', function ($user, $resume) {
            return ($user->id == $resume->user_id);
        });
        // Make sure that super Admin can edit and delete any resume he/she wants
        Gate::before(function ($user, $ablity) {
            if($user->authority == UserType::SuperAdmin) {
                return true;
            }
        });
    }
}
