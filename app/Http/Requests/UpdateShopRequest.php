<?php

namespace App\Http\Requests;

use App\Models\Shop;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateShopRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('shop_edit');
    }

    public function rules()
    {
        return [
            'user_id'     => [
                'optional',
                'integer',
            ],
            'shop_name'   => [
                'string',
                'max:150',
                'required',
            ],
            'short_name'  => [
                'string',
                'min:2',
                'max:10',
                'required',
                'unique:shops,short_name,'.$this->shop->id,
            ],
            'location'    => [
                'string',
                'required',
            ],
            'industry'    => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'max:1000',
                'nullable',
            ],
        ];
    }
}
