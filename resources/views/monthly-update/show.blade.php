@extends($module . '::layouts.master')
@section('title', __('monthly-update.show_form_title'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">{{__('monthly-update.show_form_title')}}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <br>
                <div class="card-content">
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th>{{ trans('monthly-update.monthly_update_for') }}</th>
                                <td>{{ date('F, Y', strtotime($monthlyUpdate->date)) }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('monthly-update.monthly_achievement') }}</th>
                                <td>{{ $monthlyUpdate->achievement }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('monthly-update.monthly_plan') }}</th>
                                <td>{{ $monthlyUpdate->planning }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('monthly-update.related_tasks') }}</th>
                                <td>
                                    @foreach($tasks as $task)
                                        @if($loop->iteration != count($tasks))
                                            {{ $task->name }},
                                        @else
                                            {{ $task->name }}
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th>{{ trans('labels.attachments') }}</th>
                                <td>
                                    @if(count($monthlyUpdate->attachments))
                                        <ul class="list-inline">
                                            @foreach($monthlyUpdate->attachments as $attachment)
                                                <li class="list-group-item"><a
                                                            href="{{route('file.download', ['filePath' => $attachment->file_path, 'displayName' => $attachment->file_name.'.'.$attachment->file_ext])}}"
                                                            class="badge bg-info white"
                                                            title="{{$attachment->file_name}}">{{strlen($attachment->file_name)? substr($attachment->file_name,0,10).'...': $attachment->file_name }}</a><br><label
                                                            class="label"><strong>{{$attachment->file_ext}}</strong>
                                                        file</label></li>
                                            @endforeach
                                        </ul>
                                    @else
                                        {{ trans('pms::task.no_attachments')}}
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="form-actions">
                            <a href="{{ route($module . '-monthly-updates.edit', [$monthlyUpdatable->id, $monthlyUpdate->id]) }}"
                               class="btn btn-primary"><i class="ft-edit-2"></i> {{trans('labels.edit')}}</a>
                            @php
                                if ($module == 'rms') {
                                    $monthlyUpdatableType = 'research';
                                } else {
                                    $monthlyUpdatableType = 'project';
                                }
                            @endphp
                            <a class="btn btn-warning mr-1" role="button"
                               href="{{ route($monthlyUpdatableType . '.show', $monthlyUpdatable->id) }}"> <i
                                        class="ft-x"></i> {{trans('labels.back_page')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

