<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admins;
use Laravel\Cashier\Cashier;


class PayController extends Controller
{
    public function __construct()
    {
        //Cashier::useCurrency('rmb', '￥');
    }

    //
    public function index()
    {
        return view('pay.index');
    }


    public function edit(Request $request)
    {

        //有数据返回
        if($request->stripeToken){

            \Stripe\Stripe::setApiKey("sk_test_0DStyoqg2BHbmxQ6X0C6uNIv");

            $token = $request->stripeToken;

            $charge = \Stripe\Charge::create(array(
                "amount" => 999,
                "currency" => "usd",
                "description" => "Example charge",
                "source" => $token,
            ));

        }
        /*$user = Admins::find(1);

        $user->newSubscription('main','premium')->create($request->stripeToken);*/


        echo '<pre>';
        print_r($charge->toArray());
        exit;
    }

    public function create()
    {

    }

}
