<?php

namespace App\Http\Requests;

use App\Models\Pointdeau;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePointdeauRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pointdeau_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:pointdeaus,name,' . request()->route('pointdeau')->id,
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
