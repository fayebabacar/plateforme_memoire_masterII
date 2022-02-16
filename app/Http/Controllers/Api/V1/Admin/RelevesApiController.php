<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRelefeRequest;
use App\Http\Requests\UpdateRelefeRequest;
use App\Http\Resources\Admin\RelefeResource;
use App\Models\Relefe;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RelevesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('relefe_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RelefeResource(Relefe::with(['pointdeau'])->get());
    }

    public function store(StoreRelefeRequest $request)
    {
        $relefe = Relefe::create($request->all());

        return (new RelefeResource($relefe))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Relefe $relefe)
    {
        abort_if(Gate::denies('relefe_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RelefeResource($relefe->load(['pointdeau']));
    }

    public function update(UpdateRelefeRequest $request, Relefe $relefe)
    {
        $relefe->update($request->all());

        return (new RelefeResource($relefe))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Relefe $relefe)
    {
        abort_if(Gate::denies('relefe_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $relefe->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
