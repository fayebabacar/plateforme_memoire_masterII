<?php

namespace App\Http\Requests;

use App\Models\Relefe;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRelefeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('relefe_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:releves,id',
        ];
    }
}
