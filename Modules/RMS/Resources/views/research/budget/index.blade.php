@extends('rms::layouts.master')
@section('title', trans('rms::research_budget.title'))

@section('content')
    <div class="container">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12">
                <div class="btn-group float-md-left" role="group" aria-label="Button group with nested dropdown">
                    <div class="btn-group" role="group">
                        <a class="btn btn-outline-info round" href="{{  route('research.show', $research->id) }}">
                            <i class="ft-eye"></i> @lang('rms::research.title') @lang('labels.details')
                        </a>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                    <div class="btn-group" role="group">
                        @if($research->budgets->isEmpty())
                            <a href="{{route('research-budget.create', $research->id)}}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i> @lang('labels.create') @lang('rms::research_budget.budgeting')
                            </a>
                        @else
                            <a href="{{route('research-budget.edit', $research->id)}}" class="btn btn-success btn-sm">
                                <i class="ft-edit-2 white"></i> @lang('labels.edit') @lang('rms::research_budget.budgeting')
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <br>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <section id="number-tabs">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">@lang('rms::research_budget.title')</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
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
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Sl. No.</th>
                                                    <th>Activities</th>
                                                    <th>Estimated Cost (Tk.)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php $total = 0 @endphp
                                                @foreach($research->budgets as $budget)
                                                    @php $total += $budget->estimated_cost; @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $budget->activity }}</td>
                                                    <td>{{ $budget->estimated_cost }}</td>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <th></th>
                                                    <th>Total</th>
                                                    <th>{{ $total }}</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection