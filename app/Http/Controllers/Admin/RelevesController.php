<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyRelefeRequest;
use App\Http\Requests\StoreRelefeRequest;
use App\Http\Requests\UpdateRelefeRequest;
use App\Models\Pointdeau;
use App\Models\Relefe;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RelevesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('relefe_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Relefe::with(['pointdeau'])->select(sprintf('%s.*', (new Relefe())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'relefe_show';
                $editGate = 'relefe_edit';
                $deleteGate = 'relefe_delete';
                $crudRoutePart = 'releves';

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
            $table->editColumn('type', function ($row) {
                return $row->type ? Relefe::TYPE_SELECT[$row->type] : '';
            });
            $table->addColumn('pointdeau_name', function ($row) {
                return $row->pointdeau ? $row->pointdeau->name : '';
            });

            $table->editColumn('temperature', function ($row) {
                return $row->temperature ? $row->temperature : '';
            });
            $table->editColumn('value', function ($row) {
                return $row->value ? $row->value : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'pointdeau']);

            return $table->make(true);
        }

        $pointdeaus = Pointdeau::get();

        return view('admin.releves.index', compact('pointdeaus'));
    }

    public function create()
    {
        abort_if(Gate::denies('relefe_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointdeaus = Pointdeau::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.releves.create', compact('pointdeaus'));
    }

    public function store(StoreRelefeRequest $request)
    {
        $relefe = Relefe::create($request->all());

        return redirect()->route('admin.releves.index');
    }

    public function edit(Relefe $relefe)
    {
        abort_if(Gate::denies('relefe_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pointdeaus = Pointdeau::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $relefe->load('pointdeau');

        return view('admin.releves.edit', compact('pointdeaus', 'relefe'));
    }

    public function update(UpdateRelefeRequest $request, Relefe $relefe)
    {
        $relefe->update($request->all());

        return redirect()->route('admin.releves.index');
    }

    public function show(Relefe $relefe)
    {
        abort_if(Gate::denies('relefe_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $relefe->load('pointdeau');

        return view('admin.releves.show', compact('relefe'));
    }

    public function destroy(Relefe $relefe)
    {
        abort_if(Gate::denies('relefe_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $relefe->delete();

        return back();
    }

    public function massDestroy(MassDestroyRelefeRequest $request)
    {
        Relefe::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
