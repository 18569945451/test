<?php
namespace app\Http\Models;
use Illuminate\Database\Eloquent\Model;

class Hover extends Model
{
    protected $table = 'hover';

    protected $fillable = [
        'uid', 'hover'
    ];

}