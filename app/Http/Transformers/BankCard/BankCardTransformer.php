<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2019/9/20
 * Time: 19:56
 */

namespace App\Http\Transformers\BankCard;

use App\Models\BankCard;
use Illuminate\Database\Eloquent\Collection;

class BankCardTransformer
{


    public function transform(Collection $collection)
    {
        $data=[];
        foreach ($collection as $key => $item){
            $data[$key]['id']           = $item->id;
            $data[$key]['cvv']          = $item->cvv;
            $data[$key]['month']        = $item->month;
            $data[$key]['member_id']    = $item->member_id;
            $data[$key]['created_at']   = $item->created_at;
            $data[$key]['updated_at']   = $item->updated_at;
            $data[$key]['type']         = BankCard::$type[$item->type];

        }

        return $data;
    }

}