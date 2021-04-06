<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreWithdrawRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('withdraw_create');
    }

    public function prepareForValidation()
    {
        $this->formatPhoneNumber();
    }

    protected function formatPhoneNumber(){
        return $this->merge([
            'phone' => preg_replace('/^(0|\+254)/', '254', $this->get('phone'))
        ]);
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
                'regex:/^(254)(\d){9}$/'
            ],
            'amount' => [
                'required',
            ],
        ];
    }
}
