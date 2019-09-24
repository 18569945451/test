<?php
namespace app\Http\Models;
use Illuminate\Database\Eloquent\Model;

class hobby extends Model
{
    protected $table = 'hobby';

    protected $fillable = [
        'uid', 'hobby'
    ];


    public function posts()
    {
        //一对多
        return $this->BelongsTo('App\Http\Models\Test','id','uid');
    }
}