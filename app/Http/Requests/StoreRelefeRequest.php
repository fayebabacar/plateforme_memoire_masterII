<?php

namespace App\Http\Requests;

use App\Models\Relefe;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRelefeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('relefe_create');
    }

    public function rules()
    {
        return [
            'type' => [
                'required',
            ],
            'pointdeau_id' => [
                'required',
                'integer',
            ],
            'date_releve' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'temperature' => [
                'numeric',
            ],
            'value' => [
                'numeric',
                'required',
            ],
        ];
    }
}
