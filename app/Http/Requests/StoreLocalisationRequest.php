<?php

namespace App\Http\Requests;

use App\Models\Localisation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLocalisationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('localisation_create');
    }

    public function rules()
    {
        return [
            'nom' => [
                'string',
                'required',
            ],
        ];
    }
}
