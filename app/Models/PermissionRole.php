<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class permissionRole extends Model
{

    protected $primaryKey = 'permission_id';
    protected $table = "permission_role";

    protected $fillable = [
        'permission_id', 'role_id', 'created_at','updated_at',
    ];

    protected $hidden = [
         'deleted_at',
    ];

}