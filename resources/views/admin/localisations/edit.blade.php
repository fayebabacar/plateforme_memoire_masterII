@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.localisation.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.localisations.update", [$localisation->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nom">{{ trans('cruds.localisation.fields.nom') }}</label>
                <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" type="text" name="nom" id="nom" value="{{ old('nom', $localisation->nom) }}" required>
                @if($errors->has('nom'))
                    <span class="text-danger">{{ $errors->first('nom') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.localisation.fields.nom_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="region_id">{{ trans('cruds.localisation.fields.region') }}</label>
                <select class="form-control select2 {{ $errors->has('region') ? 'is-invalid' : '' }}" name="region_id" id="region_id">
                    @foreach($regions as $id => $entry)
                        <option value="{{ $id }}" {{ (old('region_id') ? old('region_id') : $localisation->region->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('region'))
                    <span class="text-danger">{{ $errors->first('region') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.localisation.fields.region_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ville_id">{{ trans('cruds.localisation.fields.ville') }}</label>
                <select class="form-control select2 {{ $errors->has('ville') ? 'is-invalid' : '' }}" name="ville_id" id="ville_id">
                    @foreach($villes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('ville_id') ? old('ville_id') : $localisation->ville->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('ville'))
                    <span class="text-danger">{{ $errors->first('ville') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.localisation.fields.ville_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="departement_id">{{ trans('cruds.localisation.fields.departement') }}</label>
                <select class="form-control select2 {{ $errors->has('departement') ? 'is-invalid' : '' }}" name="departement_id" id="departement_id">
                    @foreach($departements as $id => $entry)
                        <option value="{{ $id }}" {{ (old('departement_id') ? old('departement_id') : $localisation->departement->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('departement'))
                    <span class="text-danger">{{ $errors->first('departement') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.localisation.fields.departement_helper') }}</span>
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