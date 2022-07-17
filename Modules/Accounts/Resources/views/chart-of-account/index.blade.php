@extends('accounts::layouts.master')
@section('title',trans('accounts::accounts.charts_of_accounts'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('accounts::accounts.charts_of_accounts')</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>

                    <div class="heading-elements">
                        <!-- Create Economy Head -->
                        <a href="{{url(route('economy-head.create'))}}" class="btn btn-outline-warning btn-sm"
                           data-toggle="modal"
                           data-target="#inlineForm">
                            <i class="ft-plus warning "></i>@lang('accounts::chart-of-accounts.import')
                        </a>

                    </div>

                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <table id="chart_of_accounts" class="table table-striped table-bordered dataex-fixh-basic"
                               style="width:100%">
                            <thead>
                            <tr>
                                <th>@lang('accounts::chart-of-accounts.type')</th>
                                <th>@lang('accounts::chart-of-accounts.category')</th>
                                <th>@lang('accounts::chart-of-accounts.sub_category')</th>
                                <th>@lang('accounts::chart-of-accounts.item')</th>
                                <th>@lang('accounts::chart-of-accounts.sub_item')</th>
                                <th>@lang('accounts::chart-of-accounts.code')</th>
                                <th>@lang('accounts::chart-of-accounts.bangla')</th>
                                <th>@lang('accounts::chart-of-accounts.english')</th>
                                <th>@lang('accounts::chart-of-accounts.description')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($economyCodes as $childHead)
                                <!-- recursively print all the chart-of-account -->
                                @include('accounts::chart-of-account.partial.recursive',$childHead)
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Attachment Modal -->
    <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="modal-title text-text-bold-600" id="myModalLabel33">@lang('labels.upload')</label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- modal body -->
                {!! Form::open(['route' => 'chart-of-accounts.store', 'class' => 'form novalidate', 'files' => true]) !!}
                <div class="modal-body">
                    {!! Form::label('attachment', trans('labels.attachments'), ['class' => 'form-label required']) !!}
                    {!! Form::file('attachment', ['class' => 'form-control required','accept'=>'.xlsx' ]) !!}

                    <div class="modal-footer">
                        <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal"
                               value=@lang('labels.closed')>
                        {!! Form::submit(trans('labels.submit'),['class'=> 'btn btn-outline-primary btn-lg'])!!}
                    </div>
                </div>
                <div class="modal-footer">
                    <p> @lang('labels.sample_file') :
                        <a href="{{route('chart-of-accounts.sample.download')}}">
                            Economy Code
                        </a>
                    </p>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection


@push('page-js')
    <script type="text/javascript">

        $('#chart_of_accounts').DataTable({
            fixedHeader: {
                header: true,
                headerOffset: $('.header-navbar').outerHeight()
            },
            "order": [],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'print'
            ],
            "paging": false
        });
    </script>
@endpush
