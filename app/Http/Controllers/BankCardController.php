<?php
namespace App\Http\Controllers;

use App\Services\WebServices\BankCardService;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;

class BankCardController extends Controller
{
    public $service;

    public function __construct()
    {
        $this->service = new BankCardService();
    }

    public function binding(Request $request)
    {
        try {
            $request->cvv = 123;
            $request->type = 1;
            $request->month = 10/2019;
            $request->number = 424242424242;
            $data = $this->service->bankCardBinding($request);
            return apiReturn($data);
        } catch (ValidatorException $e) {
            return apiReturn([], 403, $e->getMessageBag()->first());
        }
    }

    public function edit(Request $request)
    {
        try {
            $data = $this->service->bankCardEdit($request);
            return apiReturn($data);
        } catch (ValidatorException $e) {
            return apiReturn([], 403, $e->getMessageBag()->first());
        }
    }

    public function list()
    {
        try {
            $data = $this->service->bankCardList();
            return apiReturn($data);
        } catch (ValidatorException $e) {
            return apiReturn([], 403, $e->getMessageBag()->first());
        }
    }
}