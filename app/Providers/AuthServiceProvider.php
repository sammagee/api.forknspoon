<?php

namespace App\Providers;

use App\Models\Recipe;
use App\Policies\RecipePolicy;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Recipe::class => RecipePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        ResetPassword::createUrlUsing(fn($notifiable, $token) => config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}");

        //
    }
}
