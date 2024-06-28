<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Project;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('update-project', function (User $user, Project $project) {
            // Check if the user is the creator of the project
            if ($user->id === $project->creator_id) {
                return true;
            }
    
            // Check if the user has the "manager" role in this project
            if ($user->hasProjectRole('manager', $project->id)) {
                return true;
            }
    
            // If neither condition is met, deny access
            return false;
        });
      
    }
}
