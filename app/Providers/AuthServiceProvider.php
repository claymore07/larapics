<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Enums\Role;
// use App\Models\Image;
// use App\Models\User;
// use App\Policies\PolicyForImage;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        // Image::class => PolicyForImage::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        // Gate::define('update-image', function(User $user, Image $image){
        //     // dump('After image-Update');
        //     return $user->id === $image->user_id || $user->role === Role::Editor;
        // });
        //

        // Gate::define('delete-image', function(User $user, Image $image){
        //    // dump('After image-delete');
        //     return $user->id === $image->user_id;
        // });
        // ***************** Policy ***************** /
        // Gate::define('update-image', [PolicyForImage::class, 'update']);

        // Gate::define('delete-image', [PolicyForImage::class, 'delete']);

        Gate::before(function ($user, $ability) {
            if ($user->role === Role::Admin) {
                return true;
            }
        });
    }
}
