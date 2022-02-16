<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePointdeauRequest;
use App\Http\Requests\UpdatePointdeauRequest;
use App\Http\Resources\Admin\PointdeauResource;
use App\Models\Pointdeau;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PointdeauApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pointdeau_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PointdeauResource(Pointdeau::with(['localisation'])->get());
    }

    public function store(StorePointdeauRequest $request)
    {
        $pointdeau = Pointdeau::create($request->all());

        return (new PointdeauResource($pointdeau))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Pointdeau $pointdeau)
    {
        abort_if(Gate::denies('pointdeau_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PointdeauResource($pointdeau->load(['localisation']));
    }

    public function update(UpdatePointdeauRequest $request, Pointdeau $pointdeau)
    {
        $pointdeau->update($request->all());

        return (new PointdeauResource($pointdeau))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Pointdeau $pointdeau)
    {
        abort_if(Gate::denies('pointdeau_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointdeau->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
