<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankCard extends Model
{
    //银行卡类型
    const MASTER_CARD = 1;
    const VISA        = 2;
    const AMEX        = 3;
    const UNION_PAY   = 4;

    protected $table = 'v3_bankcard';

    public static $type = [

        self::MASTER_CARD => "Master Card",
        self::VISA        => "Visa",
        self::AMEX        => "Amex",
        self::UNION_PAY   => "Union Pay",
    ];

    protected $primaryKey = 'id';
    protected $fillable = ['member_id','type','number','month','cvv','created_at','updated_at','deleted_at'];

}