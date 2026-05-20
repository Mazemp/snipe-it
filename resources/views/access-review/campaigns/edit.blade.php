@extends('layouts/edit-form', [
    'createText' => trans('admin/access-review/general.new_campaign'),
    'updateText' => trans('admin/access-review/general.edit_campaign'),
    'formAction' => (isset($item->id))
        ? route('access-review.campaigns.update', ['campaign' => $item->id])
        : route('access-review.campaigns.store'),
])

@section('inputFields')

    @include ('partials.forms.edit.name', ['translated_name' => trans('admin/access-review/general.name')])

    <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
        <label for="description" class="col-md-3 control-label">
            {{ trans('admin/access-review/general.description') }}
        </label>
        <div class="col-md-7 col-sm-12">
            <textarea class="col-md-6 form-control" id="description" aria-label="description" name="description" style="min-width:100%;" rows="4">{{ old('description', $item->description) }}</textarea>
            {!! $errors->first('description', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
        </div>
    </div>

@stop
