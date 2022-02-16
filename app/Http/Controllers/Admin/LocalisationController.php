<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyLocalisationRequest;
use App\Http\Requests\StoreLocalisationRequest;
use App\Http\Requests\UpdateLocalisationRequest;
use App\Models\Departement;
use App\Models\Localisation;
use App\Models\Region;
use App\Models\Ville;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LocalisationController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('localisation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Localisation::with(['region', 'ville', 'departement'])->select(sprintf('%s.*', (new Localisation())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'localisation_show';
                $editGate = 'localisation_edit';
                $deleteGate = 'localisation_delete';
                $crudRoutePart = 'localisations';

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
            $table->editColumn('nom', function ($row) {
                return $row->nom ? $row->nom : '';
            });
            $table->addColumn('region_name', function ($row) {
                return $row->region ? $row->region->name : '';
            });

            $table->addColumn('ville_name', function ($row) {
                return $row->ville ? $row->ville->name : '';
            });

            $table->addColumn('departement_name', function ($row) {
                return $row->departement ? $row->departement->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'region', 'ville', 'departement']);

            return $table->make(true);
        }

        $regions      = Region::get();
        $villes       = Ville::get();
        $departements = Departement::get();

        return view('admin.localisations.index', compact('regions', 'villes', 'departements'));
    }

    public function create()
    {
        abort_if(Gate::denies('localisation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $regions = Region::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $villes = Ville::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $departements = Departement::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.localisations.create', compact('departements', 'regions', 'villes'));
    }

    public function store(StoreLocalisationRequest $request)
    {
        $localisation = Localisation::create($request->all());

        return redirect()->route('admin.localisations.index');
    }

    public function edit(Localisation $localisation)
    {
        abort_if(Gate::denies('localisation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $regions = Region::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $villes = Ville::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $departements = Departement::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $localisation->load('region', 'ville', 'departement');

        return view('admin.localisations.edit', compact('departements', 'localisation', 'regions', 'villes'));
    }

    public function update(UpdateLocalisationRequest $request, Localisation $localisation)
    {
        $localisation->update($request->all());

        return redirect()->route('admin.localisations.index');
    }

    public function show(Localisation $localisation)
    {
        abort_if(Gate::denies('localisation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $localisation->load('region', 'ville', 'departement');

        return view('admin.localisations.show', compact('localisation'));
    }

    public function destroy(Localisation $localisation)
    {
        abort_if(Gate::denies('localisation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $localisation->delete();

        return back();
    }

    public function massDestroy(MassDestroyLocalisationRequest $request)
    {
        Localisation::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
