<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Role;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        if (Schema::hasTable("roles")) {
            $roles = Role::get();
            foreach ($roles as $role) {
                $roleKey = $role->key;
                Gate::define($roleKey, function ($user) use ($roleKey) {
                    return $user->roles->contains('key', $roleKey) || $user->user_level == 1;
                });
            }
        }
    }
}
