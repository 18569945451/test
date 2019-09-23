<?php
namespace app\Http\Models;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = [
        'id', 'name'
    ];

    public function comments()
    {
        return $this->hasMany('App\Http\Models\Hover','uid','id');
    }
}