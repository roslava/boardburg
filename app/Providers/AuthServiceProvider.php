<?php

namespace App\Providers;


use App\Models\User;
use App\Models\Skate;


use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Skate' => 'App\Policies\SkatePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability){
            if ($user->role === "admin"AND $ability !== 'show_message_send' ){
                return true;
            }
            if ($user->role === "manager"AND $ability === 'show_message_send'){
                return true;
            }
        });

        Gate::define('update-skate', function (User $user, Skate $skate) {
            if ($user['id'] === $skate['user_id'] ) {
                return Response::allow();
            }
            return Response::deny('Нельзя редактировать чужой пост');
        });

        Gate::define('update-all', function (User $user) {
            if ($user['role'] === 'admin') {
                return Response::allow();
            }
            return Response::deny("Пользователь {$user['name']} не имеет права обновлять все посты");
        });

        Gate::define('delete-skate', function (User $user, Skate $skate) {
            if ($user['id'] == $skate['user_id']) {
                return Response::allow();
            }
            return Response::deny("Пользователь {$user['name']} не имеет права удалять чужой пост");
        });

        Gate::define('show-menu', function (User $user) {
            if ($user['role'] === 'admin') {
                return Response::allow();
            }
            return Response::deny("Пользователь {$user['name']} не имеет права видеть раздел All Users");
        });

//        Gate::define('show_message_send', function (User $user) {
//            $role = $user['role'];
//            if ($role === 'admin') return Response::deny(); elseif ($role === 'manager') return Response::allow();
//             });


        Gate::define('registered_user-allow', function (User $user) {
            if ($user['role'] === 'admin') return Response::allow();
            return Response::deny("Пользователь {$user['name']} не имеет права ни на какие действия в разделе All Users");
        });
    }
}
