<?php

namespace App\Http\Transformers\Test;
use Illuminate\Support\Collection;

class TestTransformer
{
    public function transform(Collection $collection)
    {
        $data = [];
        foreach ($collection as $key => $item) {
            $data[$key]['code']           = $item->code;
            $data[$key]['full_name']    = $item->full_name ? : '';
            $data[$key]['cleaner_name'] = $item->cleaner_name ? : '';
            $data[$key]['name']        = $item->name;
            $data[$key]['pcode']        = $item->pcode ? :'';
            $data[$key]['longitude']        = $item->longitude ? :'';
            $data[$key]['latitude']        = $item->latitude ? :'';
        }

        return $data;
    }
}
