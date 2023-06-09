<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\{Support\ServiceProvider, Http\Request, Support\Facades\Hash};
use Laravel\{Jetstream\Jetstream, Fortify\Fortify};
use App\Models\User;


class JetstreamServiceProvider extends ServiceProvider
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
        $this->configurePermissions();
        Jetstream::deleteUsersUsing(DeleteUser::class);
        Fortify::authenticateUsing(function(Request $request){
            $user = User::where('email', $request->auth)
                            ->orWhere('username', $request->auth)
                            ->first();

            if ($user &&
                Hash::check($request->password, $user->password)) {
                return $user;
            }
        });
    }

    /**
     * Configure the permissions that are available within the application.
     */
    protected function configurePermissions(): void
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
