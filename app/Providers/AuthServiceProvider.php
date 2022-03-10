<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Product;
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
        'App\Models\Product' => 'App\Policies\ProductPolicy',
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

        Gate::define('update-product', function (User $user, Product $product) {
            if ($user['id'] === $product['user_id'] ) {
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

        Gate::define('delete-product', function (User $user, Product $product) {
            if ($user['id'] == $product['user_id']) {
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

        Gate::define('registered_user-allow', function (User $user) {
            if ($user['role'] === 'admin') return Response::allow();
            return Response::deny("Пользователь {$user['name']} не имеет права ни на какие действия в разделе All Users");
        });
    }
}
