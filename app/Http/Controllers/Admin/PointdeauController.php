<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPointdeauRequest;
use App\Http\Requests\StorePointdeauRequest;
use App\Http\Requests\UpdatePointdeauRequest;
use App\Models\Localisation;
use App\Models\Pointdeau;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PointdeauController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('pointdeau_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Pointdeau::with(['localisation'])->select(sprintf('%s.*', (new Pointdeau())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'pointdeau_show';
                $editGate = 'pointdeau_edit';
                $deleteGate = 'pointdeau_delete';
                $crudRoutePart = 'pointdeaus';

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
            $table->addColumn('localisation_nom', function ($row) {
                return $row->localisation ? $row->localisation->nom : '';
            });

            $table->editColumn('latitude', function ($row) {
                return $row->latitude ? $row->latitude : '';
            });
            $table->editColumn('longitude', function ($row) {
                return $row->longitude ? $row->longitude : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'localisation']);

            return $table->make(true);
        }

        $localisations = Localisation::get();

        return view('admin.pointdeaus.index', compact('localisations'));
    }

    public function create()
    {
        abort_if(Gate::denies('pointdeau_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $localisations = Localisation::pluck('nom', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.pointdeaus.create', compact('localisations'));
    }

    public function store(StorePointdeauRequest $request)
    {
        $pointdeau = Pointdeau::create($request->all());

        return redirect()->route('admin.pointdeaus.index');
    }

    public function edit(Pointdeau $pointdeau)
    {
        abort_if(Gate::denies('pointdeau_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $localisations = Localisation::pluck('nom', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pointdeau->load('localisation');

        return view('admin.pointdeaus.edit', compact('localisations', 'pointdeau'));
    }

    public function update(UpdatePointdeauRequest $request, Pointdeau $pointdeau)
    {
        $pointdeau->update($request->all());

        return redirect()->route('admin.pointdeaus.index');
    }

    public function show(Pointdeau $pointdeau)
    {
        abort_if(Gate::denies('pointdeau_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointdeau->load('localisation');

        return view('admin.pointdeaus.show', compact('pointdeau'));
    }

    public function destroy(Pointdeau $pointdeau)
    {
        abort_if(Gate::denies('pointdeau_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointdeau->delete();

        return back();
    }

    public function massDestroy(MassDestroyPointdeauRequest $request)
    {
        Pointdeau::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
