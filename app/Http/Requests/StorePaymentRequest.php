<?php

namespace App\Http\Requests;

use App\Models\Payment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePaymentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('payment_create');
    }

    public function rules()
    {
        return [
            'sender_name'    => [
                'string',
                'nullable',
            ],
            'sender_contact' => [
                'string',
                'nullable',
            ],
            'receiver'       => [
                'string',
                'nullable',
            ],
            'code'           => [
                'string',
                'nullable',
            ],
        ];
    }
}
