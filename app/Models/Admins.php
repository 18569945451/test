<?php


namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Admins extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use EntrustUserTrait;
    use Billable;

    protected $fillable = [
        'name', 'email', 'password','api_token',
    ];

    protected $hidden = [
        'password', 'remember_token','api_token',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        // TODO: Implement getJWTIdentifier() method.
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        // TODO: Implement getJWTCustomClaims() method.
        return [];
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class,'role_admin','admin_id');
    }

}