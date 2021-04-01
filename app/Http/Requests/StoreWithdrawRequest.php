<?php

namespace App\Http\Requests;

use App\Models\Withdraw;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreWithdrawRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('withdraw_create');
    }

    public function rules()
    {
        return [
            'business_id' => [
                'required',
                'integer',
            ],
            'phone'  => [
                'string',
                'required',
            ],
            'amount' => [
                'required',
            ],
        ];
    }
}
