<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyVilleRequest;
use App\Http\Requests\StoreVilleRequest;
use App\Http\Requests\UpdateVilleRequest;
use App\Models\Ville;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class VilleController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('ville_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Ville::query()->select(sprintf('%s.*', (new Ville())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'ville_show';
                $editGate = 'ville_edit';
                $deleteGate = 'ville_delete';
                $crudRoutePart = 'villes';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.villes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('ville_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.villes.create');
    }

    public function store(StoreVilleRequest $request)
    {
        $ville = Ville::create($request->all());

        return redirect()->route('admin.villes.index');
    }

    public function edit(Ville $ville)
    {
        abort_if(Gate::denies('ville_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.villes.edit', compact('ville'));
    }

    public function update(UpdateVilleRequest $request, Ville $ville)
    {
        $ville->update($request->all());

        return redirect()->route('admin.villes.index');
    }

    public function show(Ville $ville)
    {
        abort_if(Gate::denies('ville_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.villes.show', compact('ville'));
    }

    public function destroy(Ville $ville)
    {
        abort_if(Gate::denies('ville_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ville->delete();

        return back();
    }

    public function massDestroy(MassDestroyVilleRequest $request)
    {
        Ville::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
