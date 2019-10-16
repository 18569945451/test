<?php

namespace App\Http\Transformers\Admin;

use App\Models\Admins;
use Illuminate\Support\Collection;

class IndexTransformer
{
    public function transform(Collection $collection)
    {

        $data = [];
        foreach ($collection as $key => $item){

            $data[$key] = [
                'id'                  => $item->id,
                'name'                => $item->name,
                'email'               => $item->email,
                'role'                => $item->roles[0]['display_name'],
                'created_at'          => $item->created_at->toDateTimeString(),
                'updated_at'          => $item->updated_at->toDateTimeString(),

            ];
        }

        return $data;
    }
}