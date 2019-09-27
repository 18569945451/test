<?php

namespace App\Api\V1\Test\Entities;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{

    protected $table = 'tests';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'name','password','created_at','updated_at','email','api_token','photo'
    ];
}