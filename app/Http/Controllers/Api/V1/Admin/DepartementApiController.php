<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartementRequest;
use App\Http\Requests\UpdateDepartementRequest;
use App\Http\Resources\Admin\DepartementResource;
use App\Models\Departement;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DepartementApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('departement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DepartementResource(Departement::all());
    }

    public function store(StoreDepartementRequest $request)
    {
        $departement = Departement::create($request->all());

        return (new DepartementResource($departement))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Departement $departement)
    {
        abort_if(Gate::denies('departement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DepartementResource($departement);
    }

    public function update(UpdateDepartementRequest $request, Departement $departement)
    {
        $departement->update($request->all());

        return (new DepartementResource($departement))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Departement $departement)
    {
        abort_if(Gate::denies('departement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $departement->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
