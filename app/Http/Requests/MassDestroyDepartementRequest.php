<?php

namespace App\Http\Requests;

use App\Models\Departement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDepartementRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('departement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:departements,id',
        ];
    }
}
