<?php

namespace App\Http\Requests;

use App\Models\Ville;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateVilleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ville_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
