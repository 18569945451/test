<?php
namespace app\Http\Models;
use Illuminate\Database\Eloquent\Model;

class hobby extends Model
{
    protected $table = "goods";
    protected $fillable = ['merchant_id', 'category_id', 'name', 'images', 'price', 'sales', 'created_at', 'updated_at', 'deleted_at',];
    protected $hidden = ['deleted_at'];
    protected $casts = ['images' => 'array',];

}