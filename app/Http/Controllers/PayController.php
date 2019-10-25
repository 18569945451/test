<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PayController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        return view('Pay.index');
    }

    //todo 创建支付
    public function edit()
    {
        \Stripe\Stripe::setApiKey('sk_test_97EmrCDeWEFHClmwRamnVXck001y0JYFJI');

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'name' => 'T-shirt',
                'description' => 'Comfortable cotton t-shirt',
                'images' => ['https://example.com/t-shirt.png'],
                'amount' => 500,
                'currency' => 'sgd',
                'quantity' => 1,
            ]],
            'success_url' => 'https://example.com/success?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => 'https://example.com/cancel',
        ]);

        $sessionID = $session['id'];

        //return redirect('http://www.test.div/pay/show?session_id='.$sessionID);
        return view('Pay.pay',compact('sessionID'));
    }

    public function show()
    {
        return view('Pay.pay');
    }
    //todo 支付成功的页面
    public function success(){

        return view('pay.success');
    }
    //todo 检索支付
    public function checkout(Request $request)
    {

        \Stripe\Stripe::setApiKey('sk_test_97EmrCDeWEFHClmwRamnVXck001y0JYFJI');
        echo '<pre>';
        print_r($request->all());
        exit;
        $checkout_session = \Stripe\Checkout\Session::retrieve($request->sessionID);

        return redirect('http://www.test.div/success/?session_id='.$checkout_session->id);
    }



    /*//todo 创建客户
    public function create()
    {

        \Stripe\Customer::create([
            'description' => 'Customer for jenny.rosen@example.com',
        ]);
    }

    //todo 查看客户
    public function show()
    {
         return \Stripe\Customer::retrieve('cus_G2HOEtT8dAJon8');
    }

    public function showList()
    {
        return \Stripe\Customer::all(['limit' => 3]);
    }*/



    public function edit1(Request $request)
    {

        \Stripe\Stripe::setApiKey('sk_test_97EmrCDeWEFHClmwRamnVXck001y0JYFJI');

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'name' => 'T-shirt',
                'description' => 'Comfortable cotton t-shirt',
                'images' => ['https://example.com/t-shirt.png'],
                'amount' => 500,
                'currency' => 'sgd',
                'quantity' => 1,
            ]],
            'success_url' => 'https://example.com/success?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => 'https://example.com/cancel',
        ]);


        $sessionID = $session['id'];
       // $retrieve = \Stripe\Checkout\Session::retrieve($session['id']);

        return redirect('http://www.test.div/success?session_id='.$sessionID);







        $domain_url = "http://www.test.div";
        $quantity = 1;
        $base_price = 750;
        $currency = 'usd';

        try {
            \Stripe\Stripe::setApiKey('sk_test_97EmrCDeWEFHClmwRamnVXck001y0JYFJI');
            $checkout_session = \Stripe\Checkout\Session::create([
                'success_url' => $domain_url . '/success?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => $domain_url . '/canceled',
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'name' => 'Pasha photo',
                    'images' => ["https://picsum.photos/300/300?random=4"],
                    'quantity' => $quantity,
                    'amount' => $base_price,
                    'currency' => $currency
                ]]
            ]);

            $sessionID = $checkout_session['id'];

            $checkout_session = \Stripe\Checkout\Session::retrieve($sessionID);
            echo '<pre>';
            print_r($checkout_session);
            exit;
            // Use Stripe's library to make requests...
            // todo 可以重复请求 不会执行两次相同操作
            //todo 例如，如果由于网络连接错误而导致创建收费请求没有响应，则可以使用相同的幂等性密钥重试该请求，以确保创建的收费不超过一个。
            /*$charge = \Stripe\Charge::create([
                "amount" => 1200,
                "currency" => "sgd",// todo 新加坡币 SGD$
                "source" => $request->stripeToken,
                "description" => "my payout"
            ], [
                "idempotency_key" => $request->stripeToken, // todo 执行这个函数的必须参数  具有足够熵的随机字符串来避免冲突
            ]);*/
            /*//todo  使用分页 要在PHP中使用自动分页功能，
            //todo 只需使用所需的参数发出初始的“ list ” 调用，然后调用返回的list对象以遍历所有与初始参数匹配的对象。 autoPagingIterator()
            $customers = \Stripe\Customer::all(["limit" => 3]);
            foreach ($customers->autoPagingIterator() as $customer) {
                // Do something with $customer
            }

            // todo 创建付款
            \Stripe\Payout::create([
                "amount" => 1100, //todo 支付金额 必填
                "currency" => "nzd", //todo 货币代码 小写 必须是受支持的货币 必填
                "description" => '', //todo 附加到对象的任意字符串。对于向用户显示通常很有用。 可选

            ]);*/

        } catch(\Stripe\Exception\CardException $e) {
            // Since it's a decline, \Stripe\Exception\CardException will be caught
            echo 'Status is:' . $e->getHttpStatus() . '\n';
            echo 'Type is:' . $e->getError()->type . '\n';
            echo 'Code is:' . $e->getError()->code . '\n';
            // param is '' in this case
            echo 'Param is:' . $e->getError()->param . '\n';
            echo 'Message is:' . $e->getError()->message . '\n';
        }






        /*$ch = \Stripe\Charge::retrieve(
            "ch_1FWC7RKmOEatWlVEPj1xVxbS",
            ['api_key' => "sk_test_97EmrCDeWEFHClmwRamnVXck001y0JYFJI"],
);
        $ch->capture(); // Uses the same API Key.

        //todo 一次性支付

        \Stripe\Stripe::setApiKey("sk_test_97EmrCDeWEFHClmwRamnVXck001y0JYFJI");

        $token = \Stripe\Token::create([
            'card' => [
                'number' => '4242424242424242',
                'exp_month' => 10,
                'exp_year' => 2020,
                'cvc' => '314'
            ]
        ]);*/


      /* //有数据返回
        if($request->stripeToken){

            $token = $request->stripeToken;

            $charge = \Stripe\Charge::create(array(
                "amount" => 999,
                "currency" => "usd",
                "description" => "Example charge",
                "source" => $token,
            ));

        }*/
        /*$user = Admins::find(1);

        $user->newSubscription('main','premium')->create($request->stripeToken);*/


        /*echo '<pre>';
        print_r($session->toArray());
        exit;*/
    }



}
