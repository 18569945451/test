<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2019/9/27
 * Time: 11:18
 */
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = "permissions";
    protected $fillable = ['permissions', 'created_at', 'updated_at', 'deleted_at',];
    protected $hidden = ['deleted_at'];

}
