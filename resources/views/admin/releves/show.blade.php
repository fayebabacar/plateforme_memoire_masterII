@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.relefe.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.releves.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.relefe.fields.id') }}
                        </th>
                        <td>
                            {{ $relefe->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.relefe.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Relefe::TYPE_SELECT[$relefe->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.relefe.fields.pointdeau') }}
                        </th>
                        <td>
                            {{ $relefe->pointdeau->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.relefe.fields.date_releve') }}
                        </th>
                        <td>
                            {{ $relefe->date_releve }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.relefe.fields.value') }}
                        </th>
                        <td>
                            {{ $relefe->value }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.relefe.fields.temperature') }}
                        </th>
                        <td>
                            {{ $relefe->temperature }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.releves.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection