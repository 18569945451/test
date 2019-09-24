<?php
namespace app\Http\Models;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = [
        'id', 'name'
    ];

/*    public function comments()
    {
        //一对多
        return $this->hasMany('App\Http\Models\hobby','uid','id');
    }*/
}