@extends('pms::layouts.master')
@section('title', __('monthly-update.title'))

@section('content')
    <section id="user-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{trans('monthly-update.title')}}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>

                        <div class="heading-elements">
                            <a href="{{route('project-proposal-submitted.create-monthly-update', $project->id)}}" class="btn btn-primary btn-sm"><i
                                    class="ft-plus white"></i> {{trans('monthly-update.create_button')}}</a>

                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label">{{trans('pms::project_proposal.project_title')}}</label>
                                            <input class="form-control" type="text" value="{{$project->title}}" readonly>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="label">{{trans('monthly-update.select_month')}}</label>
                                            <select class="form-control" onchange="location = this.options[this.selectedIndex].value;">
                                                <option></option>
                                                @foreach($project->monthlyUpdates as $key=>$update)
                                                    <option {{$monthYear == $update->month.'-'.$update->year ? 'selected' : ''}} value="{{route('project-proposal-submitted.monthly-update', ['projectId' => $update->update_for_id, 'monthYear' => $update->month.'-'.$update->year])}}">
                                                        {{date('F, Y', strtotime($update->year.'-'.$update->month.'-01'))}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                @if($monthYear != "")
                                    @include('monthly-update.view', ['page' => 'index'])
                                @else
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>{{trans('monthly-update.month_select_notice')}}</strong>
                                        </div>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('page-js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('select').select2({
                placeholder: {
                    id: '', // the value of the option
                    text: '{{__("monthly-update.select_month")}}'
                }
            });
        });
    </script>
@endpush
