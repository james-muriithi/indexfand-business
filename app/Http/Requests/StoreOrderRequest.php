<?php

namespace App\Http\Requests;

use App\Models\Order;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOrderRequest extends FormRequest
{
    public function authorize()
    {
//        return Gate::allows('order_create');
        return true;
    }

    public function rules()
    {
        return [
            'customer' => [
                'required',
            ],
            'products' => [
                'required',
                'array',
                'min:1'
            ],
            'customer.name' => [
                'required',
                'string',
                'min:3'
            ],
            'customer.email' => [
                'required',
                'email',
            ],
            'customer.mobile' => [
                'required',
                'regex:/^(0|\+?254)(\d){9}$/',
            ],
            'products.*.product_id' => [
                'required',
                'integer',
                'exists:products,id',
            ],
            'products.*.quantity' => [
                'required',
                'integer',
                'min:1',
            ]
        ];
    }
}
