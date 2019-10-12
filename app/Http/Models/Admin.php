<?php
namespace App\Http\Models;

use App\Http\Traits\AuthAdminTrait;
use App\Http\Traits\Searchable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{

    //
    use AuthAdminTrait;
    use Searchable;

    protected $fillable = [
        'name', 'mobile', 'password','status','api_token'
    ];
    protected $hidden = [
        'password'
    ];
    public function roles(){

        return $this->belongsToMany(Role::class);
    }
}