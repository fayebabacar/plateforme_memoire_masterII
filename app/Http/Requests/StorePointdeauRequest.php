<?php

namespace App\Http\Requests;

use App\Models\Pointdeau;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePointdeauRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pointdeau_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:pointdeaus',
            ],
            'latitude' => [
                'numeric',
            ],
            'longitude' => [
                'numeric',
            ],
        ];
    }
}
