<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    const DEFAULT_ROLE = 'member';
    const ADMIN_ROLE = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * create api_token for authentication
     *
     *@return string
     */

    public function generateToken()
    {
        $this->api_token = str_random(20);
        $this->save();

        return $this->api_token;
    }

    public function products()
    {
        return $this->hasMany('App\Models\Comment\Product');
    }

    /**
     * checks if the user belongs to a particular group
     * @param string|array $role
     * @return bool
     */
    public function role($role)
    {
        $role = (array) $role;
        return in_array($this->role, $role);
    }
}
