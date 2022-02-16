@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.relefe.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.releves.update", [$relefe->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required">{{ trans('cruds.relefe.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Relefe::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', $relefe->type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.relefe.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="pointdeau_id">{{ trans('cruds.relefe.fields.pointdeau') }}</label>
                <select class="form-control select2 {{ $errors->has('pointdeau') ? 'is-invalid' : '' }}" name="pointdeau_id" id="pointdeau_id" required>
                    @foreach($pointdeaus as $id => $entry)
                        <option value="{{ $id }}" {{ (old('pointdeau_id') ? old('pointdeau_id') : $relefe->pointdeau->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('pointdeau'))
                    <span class="text-danger">{{ $errors->first('pointdeau') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.relefe.fields.pointdeau_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_releve">{{ trans('cruds.relefe.fields.date_releve') }}</label>
                <input class="form-control date {{ $errors->has('date_releve') ? 'is-invalid' : '' }}" type="text" name="date_releve" id="date_releve" value="{{ old('date_releve', $relefe->date_releve) }}" required>
                @if($errors->has('date_releve'))
                    <span class="text-danger">{{ $errors->first('date_releve') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.relefe.fields.date_releve_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="value">{{ trans('cruds.relefe.fields.value') }}</label>
                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="number" name="value" id="value" value="{{ old('value', $relefe->value) }}" step="0.01" required>
                @if($errors->has('value'))
                    <span class="text-danger">{{ $errors->first('value') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.relefe.fields.value_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="temperature">{{ trans('cruds.relefe.fields.temperature') }}</label>
                <input class="form-control {{ $errors->has('temperature') ? 'is-invalid' : '' }}" type="number" name="temperature" id="temperature" value="{{ old('temperature', $relefe->temperature) }}" step="0.01">
                @if($errors->has('temperature'))
                    <span class="text-danger">{{ $errors->first('temperature') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.relefe.fields.temperature_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection