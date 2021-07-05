<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class InitiatePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone' => [
                'required',
                'string',
                'regex:/^(0|\+?254)(\d){9}$/',
            ],
            'account' => [
                'required',
                'exists:business,tag'
            ],
            'amount' => [
                'required',
                'integer',
                'min:10'
            ],
            'callBackUrl' => [
                'required',
                'url'
            ]
        ];
    }
}
