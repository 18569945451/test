<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Role extends Model
{
    //
    use SoftDeletes;

    const ADMIN  = 1;
    const WRITE  = 2;
    const READ   = 3;

    public static $status = [
        self::ADMIN   => "管理员",
        self::READ  => "读者",
        self::WRITE  => "写入者",
    ];


    protected $fillable = [
        'name', 'display', 'created_at', 'updated_at', 'deleted_at',
    ];
    public function permissions(){

        return $this->belongsToMany(Permission::class);
    }
    public function admins(){
        return $this->belongsToMany(Admin::class);
    }
    public function pivots(){
        return $this->hasMany(PermissionRole::class);
    }

    public function isAdminRole(){
        return $this->name === Admin::$role_admin;
    }
}
