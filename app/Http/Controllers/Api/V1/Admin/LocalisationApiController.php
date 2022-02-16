<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocalisationRequest;
use App\Http\Requests\UpdateLocalisationRequest;
use App\Http\Resources\Admin\LocalisationResource;
use App\Models\Localisation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocalisationApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('localisation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LocalisationResource(Localisation::with(['region', 'ville', 'departement'])->get());
    }

    public function store(StoreLocalisationRequest $request)
    {
        $localisation = Localisation::create($request->all());

        return (new LocalisationResource($localisation))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Localisation $localisation)
    {
        abort_if(Gate::denies('localisation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LocalisationResource($localisation->load(['region', 'ville', 'departement']));
    }

    public function update(UpdateLocalisationRequest $request, Localisation $localisation)
    {
        $localisation->update($request->all());

        return (new LocalisationResource($localisation))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Localisation $localisation)
    {
        abort_if(Gate::denies('localisation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $localisation->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
