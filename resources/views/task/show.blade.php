<?php
/**
 * Created by PhpStorm.
 * User: bs110
 * Date: 1/20/19
 * Time: 4:45 PM
 */
?>
@extends($module . '::layouts.master')
@section('title', __('pms::task.show_form_title'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">{{__('pms::task.show_form_title')}}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th>{{ trans('pms::project_proposal.project_title') }}</th>
                                <td>{{ $taskable->title }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('pms::task.task_name') }}</th>
                                <td>{{$task->name}}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('pms::task.expected_start_date') }}</th>
                                <td>{{ $task->expected_start_time ? \Carbon\Carbon::parse($task->expected_start_time)->format('d/m/Y') : '-' }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('pms::task.expected_end_date') }}</th>
                                <td>{{ $task->expected_end_time ? \Carbon\Carbon::parse($task->expected_end_time)->format('d/m/Y') : '-' }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('pms::task.start_date') }}</th>
                                <td>{{ $task->actual_start_time ? \Carbon\Carbon::parse($task->actual_start_time)->format('d/m/Y') : '-' }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('pms::task.end_date') }}</th>
                                <td>{{ $task->actual_end_time ? \Carbon\Carbon::parse($task->actual_end_time)->format('d/m/Y') : '-' }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('labels.description') }}</th>
                                <td>{{ $task->description }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('labels.attachments') }}</th>
                                <td>
                                    @if(count($task->attachments))
                                        <ul class="list-inline">
                                            @foreach($task->attachments as $attachment)
                                                <li class="list-group-item">
                                                    <a href="{{ route('file.download', [
                                        'filePath' => $attachment->path,
                                        'displayName' => $attachment->name.'.'.$attachment->ext
                                    ]) }}"
                                                       class="badge bg-info white"
                                                       title="{{ $attachment->name }}">
                                                        {{ strlen($attachment->name) ? substr($attachment->name,0,10).'...': $attachment->name  }}</a><br><label
                                                            class="label"><strong>{{$attachment->ext}}</strong>
                                                        file</label></li>
                                            @endforeach
                                        </ul>
                                    @else
                                        {{__('pms::task.no_attachments')}}
                                    @endif
                                </td>
                            </tr>

                            </tbody>
                        </table>
                        <div class="form-actions">
                            <a href="{{ route($module . '-tasks.edit', [$taskable->id, $task->id]) }}" class="btn btn-primary"><i
                                        class="ft-edit-2"></i> {{ trans('labels.edit') }}</a>

                            <a class="btn btn-warning mr-1" role="button" href="{{ route(($task->taskable_type == "research") ? 'research.show' : 'project.show', $taskable->id) }}">
                                <i class="ft-x"></i> {{trans('labels.back_page')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

