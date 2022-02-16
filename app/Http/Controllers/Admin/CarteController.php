<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCarteRequest;
use App\Http\Requests\StoreCarteRequest;
use App\Http\Requests\UpdateCarteRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CarteController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('carte_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cartes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('carte_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cartes.create');
    }

    public function store(StoreCarteRequest $request)
    {
        $carte = Carte::create($request->all());

        return redirect()->route('admin.cartes.index');
    }

    public function edit(Carte $carte)
    {
        abort_if(Gate::denies('carte_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cartes.edit', compact('carte'));
    }

    public function update(UpdateCarteRequest $request, Carte $carte)
    {
        $carte->update($request->all());

        return redirect()->route('admin.cartes.index');
    }

    public function show(Carte $carte)
    {
        abort_if(Gate::denies('carte_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cartes.show', compact('carte'));
    }

    public function destroy(Carte $carte)
    {
        abort_if(Gate::denies('carte_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carte->delete();

        return back();
    }

    public function massDestroy(MassDestroyCarteRequest $request)
    {
        Carte::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
