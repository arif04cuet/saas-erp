@extends('accounts::layouts.master')
@section('title', trans('accounts::salary-structure.title'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"
                            id="basic-layout-form">@lang('accounts::salary-structure.title')
                            @if($page == 'create')
                                @lang('labels.create')
                            @elseif($page == 'edit')
                                @lang('labels.edit')
                            @endif
                        </h4>
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
                            @include('accounts::payroll.salary-structure.form', ['page' => $page])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-api.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>

    <!-- repeater -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>

    <script>

        let selectPlaceholder = '{!! trans('labels.select') !!}';
        $(document).ready(function () {

            $("#salary_rules").select2({
                placeholder: selectPlaceholder,
                }
            );

            let categoryRepeater = $(`.repeater-category-request`).repeater({
                show: function () {
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }
                }
            });

            let salaryRules = <?php echo $salaryRulesJson; ?>;


            $("#salary_rules").change(function () {
                var rules = $(this).val();
                $("#salary-rules-table > tbody").empty();
                $.each(rules, function (index, val) {
                    $("#salary-rules-table > tbody:last-child").append(
                        "<tr><td>" + (index +1) + "</td>" +
                        "<td><a href='"+ salaryRules[val]['url'] +"' target='_blank'> " + salaryRules[val]['name'] +
                        "</a><td>" + salaryRules[val]['code'] + "</td>" +
                        "<td>" + salaryRules[val]['category'] + "<td>" + salaryRules[val]['contribution_register'] + "</td>" +
                        "</tr>"
                    );
                })

            });

            $('#salary_rules').trigger('change');
        });

    </script>
@endpush
