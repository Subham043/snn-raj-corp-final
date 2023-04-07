<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Modules\Authentication\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Modules\Authentication\Models\User' => 'App\Modules\User\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super-Admin') ? true : null;
        });

        //custom link for reset password
        ResetPassword::createUrlUsing(function (User $user, string $token) {
            return URL::temporarySignedRoute('reset_password.get', now()->addMinutes(60), ['token' => $token]);
        });
    }
}
