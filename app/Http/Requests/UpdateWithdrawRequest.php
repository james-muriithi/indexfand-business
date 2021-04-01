<?php

namespace App\Http\Requests;

use App\Models\Withdraw;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateWithdrawRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('withdraw_edit');
    }

    public function rules()
    {
        return [
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
