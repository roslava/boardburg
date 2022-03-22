<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method static create(array $array)
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'role',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return bool
     */
    function isAdmin(): bool
    {
        $admin_emails = config('settings.admin_emails');
        if (in_array($this['email'], $admin_emails)) return true; else
            return false;
    }

    /**
     * @param $currentUser
     * @param $authCheck
     * @return bool
     */
    public static function isManager($currentUser, $authCheck): bool
    {
        return $authCheck && (isset($currentUser->role) && $currentUser->role === 'manager');
    }
}
