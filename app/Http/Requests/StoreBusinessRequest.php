<?php

namespace App\Http\Requests;

use App\Models\Business;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBusinessRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('business_create');
    }

    public function rules()
    {
        return [
            'name'     => [
                'string',
                'required',
            ],
            'tag'      => [
                'string',
                'required',
                'unique:businesses',
            ],
            'contact'  => [
                'string',
                'nullable',
            ],
            'industry' => [
                'string',
                'nullable',
            ],
        ];
    }
}
