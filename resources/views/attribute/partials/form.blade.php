<div class="form-body">
    <h4 class="form-section"><i class="ft-at-sign"></i>{{ $formTitle }}</h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="form-label required">@lang('pms::project.title')</label>
                {{ Form::hidden('project_id', $project->id) }}
                {!! Form::text(null, $project->title, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'required', 'disabled']) !!}

                @if ($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <!-- name -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="form-label required">@lang('labels.name')</label>
                {!! Form::text('name', isset($attribute) ? $attribute->name : null,
                ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'required']) !!}

                @if ($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <!-- unit -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="unit" class="form-label required">@lang('attribute.unit')</label>
                {!! Form::text('unit', isset($attribute) ? $attribute->unit : null,
                    ['class' => 'form-control' . ($errors->has('unit') ? ' is-invalid' : ''), 'required']) !!}

                @if ($errors->has('unit'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('unit') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">
            <i class="la la-check-square-o"></i> {{trans('labels.save')}}
        </button>
        <a class="btn btn-warning mr-1" role="button" href="{{ route('project.show', $project->id) }}">
            <i class="ft-x"></i> {{trans('labels.cancel')}}
        </a>
    </div>
</div>
