<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_first_name',
        'user_last_name',
        'user_mobile',
        'user_mobile_cc',
        'user_email',
        'password',
        'user_city',
        'user_state',
        'user_country',
        'user_address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getDashboardRoute()
    {
        if ($this->user_role == 1) {
            return route('super-admin-dashboard');
        } elseif ($this->user_role == 2) {
            return route('customer-dashboard');
        }

        // Default route (change as needed)
        return route('default-dashboard');
    }
}
