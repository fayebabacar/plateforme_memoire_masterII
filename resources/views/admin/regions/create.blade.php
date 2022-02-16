@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.region.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.regions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.region.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.region.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="shortcode">{{ trans('cruds.region.fields.shortcode') }}</label>
                <input class="form-control {{ $errors->has('shortcode') ? 'is-invalid' : '' }}" type="text" name="shortcode" id="shortcode" value="{{ old('shortcode', '') }}">
                @if($errors->has('shortcode'))
                    <span class="text-danger">{{ $errors->first('shortcode') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.region.fields.shortcode_helper') }}</span>
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