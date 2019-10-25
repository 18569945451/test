<?php
namespace App\Services\WebServices;

use App\Models\BankCard;
use Illuminate\Http\Request;

class BankCardService
{
    public $model;

    public function __construct()
    {
        $this->model = new BankCard();
        \Stripe\Stripe::setApiKey('sk_test_97EmrCDeWEFHClmwRamnVXck001y0JYFJI');

    }
    /**
     * 银行卡绑定
     * @param Request $request
     * @return bool
     */
    public function bankCardBinding(Request $request)
    {
        //todo 创建客户
        $customer = \Stripe\Customer::create([
            'description' => $request->number,
            ]);
        //获取用户信息
        //$member = auth('member')->user();

        $this->model->cvv       = $request->cvv;
        $this->model->type      = $request->type;
        $this->model->month     = $request->month;
        $this->model->number    = $request->number;
        $this->model->member_id = 3;
        $this->model->stripe_id = $customer->id;

        $this->model->save();
        return true;
    }
    /**
     * 银行卡修改
     * @param Request $request
     * @return mixed
     */
    public function bankCardEdit(Request $request)
    {
        $data = [];
        $data['cvv']    = $request->cvv;
        $data['type']   = $request->type;
        $data['month']  = $request->month;
        $data['number'] = $request->number;

        $this->model->where('id',$request->id)->update($data);
        return true;
    }
    /**
     * 银行卡列表
     * @return array
     */
    public function bankCardList()
    {
        //获取用户id
        $id = auth('member')->id();

        $result = $this->model->where('member_id',$id)->get();

        return $result;
    }
}