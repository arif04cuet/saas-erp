@extends('tms::layouts.master')

@section('title', trans('tms::training_type.title'))

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="card-title"><h3 class="form-section"><i class="la la-tag black"></i>
                    @lang('tms::training_type.details')
                </h3></div>
                <div class="heading-elements">
                    <a href="{{route('tms-budgets.index')}}" class="btn btn-primary btn-sm"><i
                            class="ft-plus white"></i> {{trans('tms::training_type.create')}}</a>
                </div>
            </div>
            <div class="card-content ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <table class="table">
                                <tr>
                                    <th>@lang('tms::training_type.form_elements.name')</th>
                                    <td>
                                        {{ $budget->getName() ?? trans('labels.not_found') }}
                                    </td>
                                </tr>
                            </table>
                            <div class="form-actions">
                                <a href="{{ route('tms-budgets.edit', $budget->id) }}" class="master btn btn-primary"><i class="ft-edit-2"></i> {{trans('labels.edit')}}</a>
                                <a class="master btn btn-warning mr-1" role="button" href="{{route('tms-budgets.index')}}">
                                    <i class="ft-x"></i> {{trans('labels.back_page')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
