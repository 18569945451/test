<?php


namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Admins extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    protected $fillable = [
        'name', 'email', 'password','mobile',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class,'role_admin','admin_id');
    }

}