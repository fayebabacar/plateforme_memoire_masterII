@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.localisation.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.localisations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.localisation.fields.id') }}
                        </th>
                        <td>
                            {{ $localisation->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.localisation.fields.nom') }}
                        </th>
                        <td>
                            {{ $localisation->nom }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.localisation.fields.region') }}
                        </th>
                        <td>
                            {{ $localisation->region->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.localisation.fields.ville') }}
                        </th>
                        <td>
                            {{ $localisation->ville->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.localisation.fields.departement') }}
                        </th>
                        <td>
                            {{ $localisation->departement->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.localisations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection