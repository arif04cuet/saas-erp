@extends('tms::layouts.master')
@section('title', trans('tms::trainee.did_not_evaluated'))

@section('content')
    <section id="assessment">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="repeat-form"><i class="ft-list black"></i> @lang('tms::trainee.did_not_evaluated')</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row pl-2 pr-2">
                            <div class="col-md-3">
                                <label class="mt-1" for="training-filter">@lang('tms::training.title')</label>
                                <select class="custom-select select2 select-filter training-filter select mr-sm-2" id="training-search">
                                    <option selected="true" value="all">@lang('labels.all')</option>
                                    @foreach($didNotEvaluatedCourseTrainees as $key => $didNotEvaluatedCourseTrainee)
                                        @foreach($getTrainings as $getTraining)
                                            @if($didNotEvaluatedCourseTrainee->training_id == $getTraining->id)
                                                <option value="{{$getTraining->id}}">{{$getTraining->title}}</option>
                                            @endif
                                        @endforeach
                                    @endforeach

                                </select>
                            </div>
                            {{--<div class="col-md-3">--}}
                                {{--<label class="mt-1" for="course-filter">@lang('tms::course.title')</label>--}}
                                {{--<select class="custom-select select2 select-filter training-filter select mr-sm-2" id="course-search">--}}
                                    {{--<option selected="true" value="all">@lang('labels.all')</option>--}}
                                    {{--@foreach($didNotEvaluatedCourseTrainees as $key => $didNotEvaluatedCourseTrainee)--}}
                                        {{--@foreach($getCourses as $getCourse)--}}
                                            {{--@if($didNotEvaluatedCourseTrainee->training_id == $getCourse->training_id)--}}
                                                {{--<option value="{{$getCourse->id}}">{{$getCourse->name}}</option>--}}
                                            {{--@endif--}}
                                        {{--@endforeach--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--</div>--}}
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="master table table-striped table-bordered alt-pagination">
                                        <thead>
                                        <tr>
                                            <th>@lang('labels.serial')</th>
                                            <th style="display: none">@lang('labels.serial')</th>
                                            <th data-index-key="trainee-en-name">@lang('tms::training.full_name')
                                                (@lang('tms::training.in_bangla'))
                                            </th>
                                            <th data-index-key="trainee-bn-name">@lang('tms::training.full_name')
                                                (@lang('tms::training.in_english'))
                                            </th>
                                            <th data-index-key="trainee-mobile">@lang('labels.mobile')</th>
                                            <th data-index-key="trainee-email">@lang('tms::training.email')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($didNotEvaluatedCourseTrainees as $key => $didNotEvaluatedCourseTrainee)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td style="display: none">{{ $didNotEvaluatedCourseTrainee->training_id }}</td>
                                                <td>{{ $didNotEvaluatedCourseTrainee->bangla_name }}</td>
                                                <td>{{ $didNotEvaluatedCourseTrainee->english_name }}</td>
                                                <td>{{ $didNotEvaluatedCourseTrainee->mobile }}</td>
                                                <td>{{ $didNotEvaluatedCourseTrainee->email }}</td>
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
        </div>
    </section>
@endsection

@push('page-js')
    <script>
        $(document).ready(function () {
            let table = $('.table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'csv', className: 'csv',
                    },
                    {
                        extend: 'excel', className: 'excel',
                    },
                ],
                paging: true,
                searching: true,
                "bDestroy": true,
            });
            table.draw()
            $('select').select2({});
        })


        $(document).ready(function() {
            let table =  $('.table').DataTable();

            $('#training-search').on('change', function () {
                if (this.value === 'all'){
                    table.columns(1).search("").draw();
                }else {
                    table.columns(1).search( this.value ).draw();
                }
            } );
            // $('#course-search').on('change', function () {
            //     if (this.value === 'all'){
            //         table.columns(2).search("").draw();
            //     }else {
            //         table.columns(2).search( this.value ).draw();
            //     }
            // } );


            let a = new Array();
            $("#training-search").children("option").each(function(x){
                test = false;
                b = a[x] = $(this).val();
                for (i=0;i<a.length-1;i++){
                    if (b ==a[i]) test =true;
                }
                if (test) $(this).remove();
            });

            a = new Array();
            $("#course-search").children("option").each(function(x){
                test = false;
                b = a[x] = $(this).val();
                for (i=0;i<a.length-1;i++){
                    if (b ==a[i]) test =true;
                }
                if (test) $(this).remove();
            })
        });
    </script>
@endpush
