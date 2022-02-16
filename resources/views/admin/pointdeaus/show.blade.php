@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pointdeau.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pointdeaus.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pointdeau.fields.id') }}
                        </th>
                        <td>
                            {{ $pointdeau->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointdeau.fields.name') }}
                        </th>
                        <td>
                            {{ $pointdeau->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointdeau.fields.localisation') }}
                        </th>
                        <td>
                            {{ $pointdeau->localisation->nom ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointdeau.fields.latitude') }}
                        </th>
                        <td>
                            {{ $pointdeau->latitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pointdeau.fields.longitude') }}
                        </th>
                        <td>
                            {{ $pointdeau->longitude }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pointdeaus.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection