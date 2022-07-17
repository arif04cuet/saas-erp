@extends('hrm::layouts.master')
@section('title', trans('hrm::job-circular.recruitment_exam.title'))
{{--@section("employee_create", 'active')--}}


@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('hrm::job-circular.recruitment_exam.title') @lang('labels.list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{route('recruitment-exams.create')}}" class="btn btn-primary btn-sm"><i
                                    class="ft-plus white"></i>@lang('labels.add')</a>

                        </div>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination" id="DepartmentTable">
                                    <thead>
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        <th>@lang('labels.title')</th>
                                        <th>@lang('hrm::job-circular.recruitment_exam.total')</th>
                                        <th>@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($exams as $exam)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <th>{{ optional($exam->circular)->title ?? __('labels.not_found') }}</th>
                                            <td>
                                                {{$exam->preliminary_total + $exam->written_total +
                                                    $exam->aptitude_total + $exam->viva_total }}
                                            </td>

                                            <td>
                                                <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                    <i class="la la-cog"></i></button>
                                                <span aria-labelledby="btnSearchDrop2"
                                                      class="dropdown-menu mt-1 dropdown-menu-right">
                                                    @if ($exam->status != 'completed')
                                                        <a href="{{ route('recruitment-exam-marks.create', $exam->circular->id) }}"
                                                           class="dropdown-item">
                                                            <i class="ft-edit-2"></i>
                                                            @lang('hrm::job-circular.exam_marks.title')
                                                            <div class="dropdown-divider"></div>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('recruitment-exam-marks.result', $exam->circular->id) }}"
                                                           class="dropdown-item">
                                                            <i class="ft-edit-2"></i>
                                                            @lang('hrm::job-circular.result.title')
                                                            <div class="dropdown-divider"></div>
                                                        </a>
                                                    @endif
                                                     <a class="dropdown-item"
                                                        title="{{__('hrm::job-circular.admit_card.create')}}"
                                                        href="{{ route('job-admit-cards.create', $exam->job_circular_id) }}">
                                                         <i class="ft ft-file-plus"></i>
                                                         @lang('hrm::job-circular.admit_card.create')
                                                     </a>
                                                        <div class="dropdown-divider"></div>
                                                        <a href="{{ route('recruitment-exams.show', $exam->id) }}"
                                                           class="dropdown-item">
                                                            <i class="ft-eye"></i>
                                                            @lang('labels.details')
                                                        </a>
                                                         <div class="dropdown-divider"></div>
                                                        <a href="{{ route('recruitment-exams.edit', $exam->id) }}"
                                                           class="dropdown-item">
                                                            <i class="ft-edit-2"></i>
                                                            @lang('labels.edit')
                                                        </a>
                                                </span>

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-js')


    <script>

        //        table export configuration
        $(document).ready(function () {
            $('#DepartmentTable').DataTable({
                paging: true,
                searching: true,
                "bDestroy": true,
            });
        });

        function confirmMessage() {
            if (!confirm("{{ trans('labels.confirm_delete') }}"))
                event.preventDefault();
        }
    </script>

@endpush
