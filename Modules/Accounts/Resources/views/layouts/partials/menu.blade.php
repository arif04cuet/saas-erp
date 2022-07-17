<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        @auth
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="{{ request()->routeIs('accounts') ? 'active' : '' }}">
                    <a href="{{ route('accounts') }}">
                        <i class="la la-home"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">
                            @lang('labels.dashboard')
                        </span>
                    </a>
                </li>


                <!-- Accounting -->
                <li class="nav-item">
                    <a href="#" class=""><i class="la la-balance-scale"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">
                            @lang('accounts::accounts.title')
                        </span>
                    </a>
                    <ul class="menu-content">

                        <!-- Fiscal Year -->
                        <li class="{{ request()->routeIs('fiscal-year.index') ? 'active' : '' }}">
                            <a href="{{ route('fiscal-year.index') }}">
                                <i class="la la-calendar-o"></i>
                                @lang('accounts::fiscal-year.title')
                            </a>
                        </li>

                        <!-- Journal -->
                        <li>
                            <a href="#" class=""><i class="la la-book"></i>
                                @lang('accounts::journal.title')</a>
                            <ul class="menu-content">

                                <!-- Create Journal -->
                                <li class="{{request()->routeIs('journal.create') ? 'active' : ''}}">
                                    <a href="{{route('journal.create')}}">
                                        <i class="la la-arrow-circle-o-right"></i>

                                        {{ trans('accounts::configuration.journal.create') }}

                                    </a>
                                </li>

                                <!-- Journal List -->
                                <li class="{{request()->routeIs('journal.index') ? 'active' : ''}}">
                                    <a href="{{route('journal.index')}}">
                                        <i class="la la-arrow-circle-o-right"></i>
                                        {{ trans('accounts::journal.index') }}
                                    </a>
                                </li>


                            </ul>
                        </li>

                        <!-- Journal Entry -->
                        <li>
                            <a href="#" class=""><i class="ft ft-file-plus"></i>
                                @lang('accounts::journal.entry.title')</a>
                            <ul class="menu-content">

                                <!-- Journal Entry List -->
                                <li class="{{request()->routeIs('journal.entry.index') ? 'active' : ''}}">
                                    <a href="{{route('journal.entry.index')}}">
                                        <i class="la la-arrow-circle-o-right"></i>
                                        {{ trans('accounts::journal.entry.index') }}
                                    </a>
                                </li>
                                <!-- Cash Book Entry -->
                                <li class="{{request()->routeIs('cash-book-entry.index') ? 'active' : ''}}">
                                    <a href="{{route('cash-book-entry.index')}}">
                                        <i class="la la-arrow-circle-o-right"></i>
                                        {{ trans('accounts::journal.entry.cash_book.index') }}
                                    </a>
                                </li>

                                <!-- Transaction History -->
                                <li class="{{request()->routeIs('account-transaction-history.index') ? 'active' : ''}}">
                                    <a href="{{route('account-transaction-history.index')}}">
                                        <i class="la la-arrow-circle-o-right"></i>
                                        <span class="menu-title"
                                                data-i18n="nav.dash.main">{{ trans('accounts::journal.history.title') }}</span>
                                    </a>
                                </li>

                            <!-- Account Balance -->
                                <li class="{{request()->routeIs('account-balance.index') ? 'active' : ''}}">
                                    <a href="{{route('account-balance.index')}}">
                                        <i class="la la-arrow-circle-o-right"></i>
                                        {{ trans('accounts::account-balance.title') }}
                                    </a>
                                </li>

                                <!-- Employee Advance Payment List -->
                                <li class="{{request()->routeIs('advance-payment.index') ? 'active' : ''}}">
                                    <a href="{{route('advance-payment.index')}}"
                                       title="{{ trans('accounts::journal.entry.advance_payment.index') }}">
                                        <i class="la la-arrow-circle-o-right"></i>
                                        {{ trans('accounts::journal.entry.advance_payment.index') }}
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <!-- / Journal Entry -->

                        <!-- Budget Menu -->

                        <!-- Budget -->
                        <li class="nav-item">
                            <a href="#" class=""><i class="la la-money"></i>
                                {{ trans('accounts::budget.title') }}</a>
                            <ul class="menu-content">

                                <!-- Index -->
                                <ul class="menu-content">
                                    <li class="{{ request()->is('accounts/budgets/report') == 'active' ?
                                    '' : request()->routeIs('budgets.index')}}">
                                        <a href="{{route('budgets.index')}}">
                                            <i class="la la-arrow-circle-o-right"></i>
                                            {{ trans('accounts::budget.index') }}
                                        </a>
                                    </li>
                                </ul>

                                <!-- Cost Center -->
                                <ul class="menu-content">
                                    <li class="{{request()->routeIs('budget-cost-centers.index') ? 'active' : ''}}">
                                        <a href="{{route('budget-cost-centers.index')}}">
                                            <i class="la la-arrow-circle-o-right"></i>
                                            @lang('accounts::budget.cost_center.index')

                                        </a>
                                    </li>
                                </ul>

                                <!-- Budget Reports -->
                                <ul class="menu-content">
                                    <li class="{{request()->routeIs('budgets.report') ? 'active' : ''}}">
                                        <a href="{{route('budgets.report')}}">

                                            <i class="la la-arrow-circle-o-right"></i>
                                            @lang('accounts::budget.report')
                                        </a>
                                    </li>
                                </ul>

                                {{--<!-- Revenue Budget -->--}}
                                {{--<li class="{{is_active_route('revenue-budget.index')}}">--}}
                                {{--<a href="{{route('revenue-budget.index')}}">--}}
                                {{--<i class="la la-arrow-circle-o-right"></i>--}}
                                {{--<span class="menu-title"--}}
                                {{--data-i18n="nav.dash.main">{{ trans('accounts::budget.revenue_budget') }}</span>--}}
                                {{--</a>--}}
                                {{--</li>--}}

                                {{--<!-- Local Budget -->--}}
                                {{--<li class="{{is_active_route('local-budget.index')}}">--}}
                                {{--<a href="{{route('local-budget.index')}}">--}}
                                {{--<i class="la la-arrow-circle-o-right"></i>--}}
                                {{--<span class="menu-title"--}}
                                {{--data-i18n="nav.dash.main">{{ trans('accounts::budget.local_budget') }}</span>--}}
                                {{--</a>--}}
                                {{--</li>--}}

                                {{--<!-- Local Income -->--}}
                                {{--<li class="{{is_active_route('local-income.index')}}">--}}
                                {{--<a href="{{route('local-income.index')}}">--}}
                                {{--<i class="la la-arrow-circle-o-right"></i>--}}
                                {{--<span class="menu-title"--}}
                                {{--data-i18n="nav.dash.main">{{ trans('accounts::budget.local_income') }}</span>--}}
                                {{--</a>--}}
                                {{--</li>--}}


                            </ul>
                        </li>

                        <!-- Chart Of Accounts -->
                        <li>
                            <a href="#" class=""><i class="la la-bank"></i>
                                @lang('accounts::accounts.charts_of_accounts')
                            </a>

                            <ul class="menu-content">

                                <!-- Economy Code -->
                                <li class="{{ request()->routeIs('economy-code.index') ? 'active' : '' }}">
                                    <a href="{{ route('economy-code.index') }}">
                                        <i class="la la-tags"></i>
                                        @lang('accounts::economy-code.title')</a>
                                </li>

                                <!-- Economy Head -->
                                <li class="{{ request()->routeIs('economy-head.index') ? 'active' : '' }}">
                                    <a href="{{ route('economy-head.index') }}">
                                        <i class="la la-tag"></i>
                                        @lang('accounts::economy-head.title')
                                    </a>
                                </li>

                                <!-- Economy Sector -->
                                <li class="{{ request()->routeIs('economy-sectors.index') ? 'active' : '' }}">
                                    <a href="{{ route('economy-sectors.index') }}">
                                        <i class="la la-tag"></i>
                                        @lang('accounts::accounts.sector.title')

                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('economy-code-settings.index') ? 'active' : '' }}">
                                    <a href="{{ route('economy-code-settings.index') }}">
                                        <i class="la la-cog"></i>
                                        @lang('accounts::economy-code.settings.title')

                                    </a>
                                </li>

                                <!-- View of COA -->
                                <li class="{{ request()->routeIs('chart-of-accounts.index') ? 'active' : '' }}">
                                    <a href="{{route('chart-of-accounts.index')}}">
                                        <i class="la la-calendar-o"></i>
                                        {{trans('labels.list')}}</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="" class="nav-item"><i class="la la-newspaper-o"></i>
                                @lang('accounts::accounts.report.title')
                            </a>
                            <!-- Accounts Report -->
                            <ul class="menu-content">
                                <li class="{{ request()->routeIs('reports.index') ? 'active' : '' }}">
                                    <a href="{{ route('reports.index') }}">
                                        <i class="la la-calendar-o"></i>
                                        @lang('accounts::accounts.report.show')
                                    </a>
                                </li>
                            </ul>
                        </li>


                    </ul>
                </li>

            {{--                <!-- Sales -->--}}
            {{--                <li class="nav-item">--}}
            {{--                    <a href="#" class=""><i class="la la-credit-card"></i>--}}
            {{--                        <span class="menu-title"--}}
            {{--                              data-i18n="nav.templates.main">Sales</span></a>--}}
            {{--                    <ul class="menu-content">--}}
            {{--                        <!-- Invoice -->--}}
            {{--                        <li class="nav-item">--}}
            {{--                            <a href="#" class=""><i class="la la-cart-plus"></i>--}}
            {{--                                <span class="menu-title"--}}
            {{--                                      data-i18n="nav.templates.main">{{ trans('accounts::invoice.title') }}</span></a>--}}
            {{--                            <ul class="menu-content">--}}
            {{--                                <!-- Invoice List -->--}}
            {{--                                <li class="{{is_active_route('invoice.index')}}">--}}
            {{--                                    <a href="{{route('invoice.index')}}">--}}
            {{--                                        <i class="la la-arrow-circle-o-right"></i>--}}
            {{--                                        <span class="menu-title"--}}
            {{--                                              data-i18n="nav.dash.main">{{ trans('accounts::invoice.invoice_list') }}</span>--}}
            {{--                                    </a>--}}
            {{--                                </li>--}}
            {{--                            </ul>--}}
            {{--                        </li>--}}

            {{--                        <!-- Customer -->--}}
            {{--                        <li class="nav-item">--}}
            {{--                            <a href="#" class=""><i class="ft ft-users"></i>--}}
            {{--                                <span class="menu-title"--}}
            {{--                                      data-i18n="nav.templates.main">{{ trans('accounts::customer.title') }}</span></a>--}}
            {{--                            <!-- Create -->--}}
            {{--                            <ul class="menu-content">--}}
            {{--                                <li class="{{is_active_route('customer.create')}}">--}}
            {{--                                    <a href="{{route('customer.create')}}">--}}
            {{--                                        <i class="la la-arrow-circle-o-right"></i>--}}
            {{--                                        <span class="menu-title"--}}
            {{--                                              data-i18n="nav.dash.main">{{ trans('accounts::customer.create') }}</span>--}}
            {{--                                    </a>--}}
            {{--                                </li>--}}
            {{--                            </ul>--}}

            {{--                            <!-- Index -->--}}
            {{--                            <ul class="menu-content">--}}
            {{--                                <li class="{{is_active_route('customer.index')}}">--}}
            {{--                                    <a href="{{route('customer.index')}}">--}}
            {{--                                        <i class="la la-arrow-circle-o-right"></i>--}}
            {{--                                        <span class="menu-title"--}}
            {{--                                              data-i18n="nav.dash.main">{{ trans('accounts::customer.index') }}</span>--}}
            {{--                                    </a>--}}
            {{--                                </li>--}}
            {{--                            </ul>--}}
            {{--                        </li>--}}
            {{--                    </ul>--}}
            {{--                </li>--}}

            {{--                <!-- Purchase -->--}}
            {{--                <li class="nav-item">--}}
            {{--                    <a href="#" class=""><i class="fa ft-shopping-cart"></i>--}}
            {{--                        <span class="menu-title"--}}
            {{--                              data-i18n="nav.templates.main">Purchase</span></a>--}}
            {{--                    <ul class="menu-content">--}}

            {{--                        <!-- Bill -->--}}
            {{--                        <li class="nav-item">--}}
            {{--                            <a href="#" class=""><i class="ft ft-file-plus"></i>--}}
            {{--                                <span class="menu-title"--}}
            {{--                                      data-i18n="nav.templates.main">{{ trans('accounts::bill.title') }}</span></a>--}}
            {{--                            <ul class="menu-content">--}}

            {{--                                <!-- Bill List -->--}}
            {{--                                <li class="{{is_active_route('accounts.bill.index')}}">--}}
            {{--                                    <a href="{{route('accounts.bill.index')}}">--}}
            {{--                                        <i class="la la-arrow-circle-o-right"></i>--}}
            {{--                                        <span class="menu-title"--}}
            {{--                                              data-i18n="nav.dash.main">{{ trans('accounts::bill.index') }}</span>--}}
            {{--                                    </a>--}}
            {{--                                </li>--}}
            {{--                            </ul>--}}
            {{--                        </li>--}}

            {{--                        <!-- Vendor -->--}}
            {{--                        <li class="nav-item">--}}
            {{--                            <a href="#" class=""><i class="ft ft-users"></i>--}}
            {{--                                <span class="menu-title"--}}
            {{--                                      data-i18n="nav.templates.main">{{ trans('accounts::vendor.title') }}</span></a>--}}
            {{--                            <!-- Create -->--}}
            {{--                            <ul class="menu-content">--}}
            {{--                                <li class="{{is_active_route('accounts.vendor.create')}}">--}}
            {{--                                    <a href="{{route('accounts.vendor.create')}}">--}}
            {{--                                        <i class="la la-arrow-circle-o-right"></i>--}}
            {{--                                        <span class="menu-title"--}}
            {{--                                              data-i18n="nav.dash.main">{{ trans('accounts::vendor.create') }}</span>--}}
            {{--                                    </a>--}}
            {{--                                </li>--}}
            {{--                            </ul>--}}

            {{--                            <!-- Index -->--}}
            {{--                            <ul class="menu-content">--}}
            {{--                                <li class="{{is_active_route('accounts.vendor.index')}}">--}}
            {{--                                    <a href="{{route('accounts.vendor.index')}}">--}}
            {{--                                        <i class="la la-arrow-circle-o-right"></i>--}}
            {{--                                        <span class="menu-title"--}}
            {{--                                              data-i18n="nav.dash.main">{{ trans('accounts::vendor.index') }}</span>--}}
            {{--                                    </a>--}}
            {{--                                </li>--}}
            {{--                            </ul>--}}
            {{--                        </li>--}}

            {{--                        <!-- Receipt -->--}}
            {{--                        <li class="nav-item">--}}
            {{--                            <a href="#" class=""><i class="la la-money"></i>--}}
            {{--                                <span class="menu-title"--}}
            {{--                                      data-i18n="nav.templates.main">{{ trans('accounts::receipt-payment.title') }}</span></a>--}}
            {{--                            <!-- Create -->--}}
            {{--                            <ul class="menu-content">--}}
            {{--                                <li class="{{is_active_route('receipt-payment.create')}}">--}}
            {{--                                    <a href="{{route('receipt-payment.create')}}">--}}
            {{--                                        <i class="la la-arrow-circle-o-right"></i>--}}
            {{--                                        <span class="menu-title"--}}
            {{--                                              data-i18n="nav.dash.main">{{ trans('accounts::receipt-payment.create') }}</span>--}}
            {{--                                    </a>--}}
            {{--                                </li>--}}
            {{--                            </ul>--}}

            {{--                            <!-- Index -->--}}
            {{--                            <ul class="menu-content">--}}
            {{--                                <li class="{{is_active_route('receipt-payment.index')}}">--}}
            {{--                                    <a href="{{route('receipt-payment.index')}}">--}}
            {{--                                        <i class="la la-arrow-circle-o-right"></i>--}}
            {{--                                        <span class="menu-title"--}}
            {{--                                              data-i18n="nav.dash.main">{{ trans('accounts::receipt-payment.index') }}</span>--}}
            {{--                                    </a>--}}
            {{--                                </li>--}}
            {{--                            </ul>--}}
            {{--                        </li>--}}

            {{--                    </ul>--}}
            {{--                </li>--}}


            <!-- Payroll -->
                <li class="nav-item">
                    <a href="#" class=""><i class="la la-money"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">
                        {{ trans('accounts::payroll.title') }}
                        </span>
                    </a>
                    <ul class="menu-content">
                        <!--  Employee Payslips -->
                        <li class="nav-item">
                            <a href="#" class=""><i class="la la-money"></i>
                                {{ trans('accounts::payroll.payslip.title') }}</a>
                            <ul class="menu-content">
                                <!-- Employee Payslips -->
                                <li class="{{request()->routeIs('payslips.create') ? 'active' : ''}}">
                                    <a href="{{route('payslips.create')}}">
                                        <i class="la la-arrow-circle-o-right"></i>
                                        {{ trans('accounts::payroll.payslip.create') }}
                                    </a>
                                </li>

                                <!-- View Employee Payslips -->
                                <li class="{{request()->routeIs('payslips.index') ? 'active' : ''}}">
                                    <a href="{{route('payslips.index')}}">
                                        <i class="la la-arrow-circle-o-right"></i>
                                        {{ trans('accounts::payroll.payslip.index') }}
                                    </a>
                                </li>

                                <!-- Workflow for Payslips -->
                                <li class="{{request()->routeIs('payslips-workflow.create') ? 'active' : ''}}">
                                    <a href="{{route('payslips-workflow.create')}}">
                                        <i class="la la-arrow-circle-o-right"></i>
                                        {{ trans('accounts::payroll.payslip.approval') }}

                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Employee Payslip Batch -->
                        <li class="nav-item">
                            <a href="" class=""><i class="la la-money"></i>

                                {{ trans('accounts::payroll.payslip_batch.title') }}

                            </a>
                            <ul class="menu-content">
                                <!-- Employee Payslips -->
                                <li class="{{request()->routeIs('payslip-batches.create') ? 'active' : ''}}">
                                    <a href="{{route('payslip-batches.create')}}">
                                        <i class="la la-arrow-circle-o-right"></i>
                                        {{ trans('accounts::payroll.payslip_batch.create') }}
                                    </a>
                                </li>

                                <!-- View Employee Payslips -->
                                <li class="{{request()->routeIs('payslip-batches.index') ? 'active' : ''}}">
                                    <a href="{{route('payslip-batches.index')}}">
                                        <i class="la la-arrow-circle-o-right"></i>
                                        {{ trans('accounts::payroll.payslip_batch.index') }}
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!--  Master Roll -->
                        <li class="nav-item">
                            <a href="" class=""><i class="la la-money"></i>

                                {{ trans('accounts::payroll.master_roll.title') }}

                            </a>
                            <ul class="menu-content">
                                <!-- Create Master Roll Salary -->
                                <li class="{{request()->routeIs('master-roll.salary.create') ? 'active' : ''}}">
                                    <a href="{{route('master-roll.salary.create')}}">
                                        <i class="la la-arrow-circle-o-right"></i>

                                        {{ trans('accounts::payroll.master_roll.create') }}

                                    </a>
                                </li>

                                <!-- View Master Roll Salary -->
                                <li class="{{request()->routeIs('master-roll.salary.index') ? 'active' : ''}}">
                                    <a href="{{route('master-roll.salary.index')}}">
                                        <i class="la la-arrow-circle-o-right"></i>
                                        {{ trans('accounts::payroll.master_roll.index') }}
                                    </a>
                                </li>

                                <!-- Master Roll Contract -->
                                <li class="{{request()->routeIs('master-roll.employee.index') ? 'active' : ''}}">
                                    <a href="{{route('master-roll.employee.index')}}">
                                        <i class="la la-arrow-circle-o-right"></i>
                                        {{ trans('accounts::payroll.master_roll.contract') }}
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Employee and Master Roll Contract -->

                        <!-- Employee Contract -->
                        <li class="{{request()->is('accounts/employee-contracts') ? 'active' : ''}}">
                            <a href="{{route('employee-contracts.index')}}">
                                <i class="la la-arrow-circle-o-right"></i>
                                {{ trans('accounts::employee-contract.title') }}
                            </a>
                        </li>


                        <!-- Salary Rule -->
                        <li class="{{request()->is('accounts/payroll/salary-rule') ? 'active' : ''}}">
                            <a href="{{route('salary-rule.index')}}">
                                <i class="la la-arrow-circle-o-right"></i>
                                {{ trans('accounts::salary-rule.title') }}
                            </a>
                        </li>
                        <!-- Salary Structure -->
                        <li class="{{request()->is('accounts/salary-structures') ? 'active' : ''}}">
                            <a href="{{route('salary-structures.index')}}">
                                <i class="la la-arrow-circle-o-right"></i>
                                {{ trans('accounts::salary-structure.title') }}
                            </a>
                        </li>

                        <!-- Payscale  -->
                        <li class="{{request()->is('accounts/payscales') ? 'active' : ''}}">
                            <a href="{{route('payscales.index')}}">
                                <i class="la la-arrow-circle-o-right"></i>
                                {{ trans('accounts::payscale.title') }}
                            </a>
                        </li>

                        <!-- Promotion  -->
                        <li class="{{request()->is('accounts.promotion.index') ? 'active' : ''}}">
                            <a href="{{route('accounts.promotion.index')}}">
                                <i class="la la-arrow-circle-o-right"></i>
                                {{ trans('accounts::payroll.promotion.menu_title') }}
                            </a>
                        </li>

                        <!-- Employee Payslips Report -->
                        <li class="{{ request()->routeIs('payslips.reports.create') ? 'active' : '' }}">
                            <a href="{{route('payslips.reports.create')}}">
                                <i class="la la-arrow-circle-o-right"></i>
                                @lang('accounts::payroll.payslip_report.create')
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- GPF -->
                <li class="nav-item">
                    <a href="#" class=""><i class="la la-money"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">
                            {{ trans('accounts::gpf.title') }}
                        </span>
                    </a>
                    <ul class="menu-content">
                        <!--  GPF List -->
                        <li class="{{request()->is('accounts/gpf/') ? 'active' : ''}}">
                            <a href="{{route('gpf.index')}}">
                                <i class="la la-arrow-circle-o-right"></i>
                                {{ trans('accounts::gpf.gpf_list') }}
                            </a>
                        </li>
                        <!-- GPF Loan -->
                        <li class="{{request()->is('accounts/gpf-loans') ? 'active' : ''}}">
                            <a href="{{route('gpf-loans.index')}}">
                                <i class="la la-arrow-circle-o-right"></i>
                                {{ trans('accounts::gpf.loan.title') }}
                            </a>
                        </li>

                        <li class="{{ request()->is('accounts/gpf-configurations') ? 'active' : ''}}">
                            <a href="{{route('gpf-configurations.index')}}">
                                <i class="la la-arrow-circle-o-right"></i>
                                {{ trans('accounts::gpf.configuration.title') }}
                            </a>
                        </li>

                    </ul>
                </li>

                <!-- PRL & Pension -->

                <li class="nav-item">
                    <a href="#" class=""><i class="la la-money"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">
                            {{trans('accounts::prl.combined_title')}}
                        </span>
                    </a>
                    <ul class="menu-content">

                        <!-- PRL -->
                        <li class="nav-item">
                            <a href="#" class=""><i class="la la-money"></i>
                                {{trans('accounts::prl.short_title')}} </a>
                            <ul class="menu-content">

                                <!-- Create PRL -->
                                <li class="{{request()->routeIs('prl.create') ? 'active' : ''}}">
                                    <a href="{{route('prl.create')}}">
                                        <i class="la la-arrow-circle-o-right"></i>
                                        {{trans('accounts::prl.create')}}
                                    </a>
                                </li>

                                <!-- PRL List -->
                                <li class="{{request()->routeIs('prl.index') ? 'active' : ''}}">
                                    <a href="{{route('prl.index')}}">
                                        <i class="la la-arrow-circle-o-right"></i>
                                        {{trans('accounts::prl.index')}}
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <!-- Pension -->
                        <li class="nav-item">
                            <a href="#" class=""><i class="la la-money"></i>
                                {{trans('accounts::pension.title')}} </a>
                            <ul class="menu-content">

                                <!-- Lump Sum Pension -->
                                <li class="{{request()->routeIs('lump-sum.index') ? 'active' : ''}}">
                                    <a href="{{route('lump-sum.index')}}">
                                        <i class="la la-arrow-circle-o-right"></i>
                                        {{trans('accounts::pension.lump_sum.title')}}
                                    </a>
                                </li>


                                <!-- Monthly Pension -->
                                <li class="{{request()->is('accounts/pensions/monthly-pensions/').
request()->is('accounts/pensions/monthly-pensions/create')}}">
                                    <a href="{{route('monthly-pensions.index')}}">
                                        <i class="la la-arrow-circle-o-right"></i>
                                        {{ trans('accounts::pension.monthly.title') }}

                                    </a>
                                </li>

                                <!-- Monthly Pension Contracts -->
                                <li class="{{request()->is('accounts/pensions/monthly-pension-contracts')}}">
                                    <a href="{{route('monthly-pension-contracts.index')}}">
                                        <i class="la la-arrow-circle-o-right"></i>
                                        @lang('accounts::pension.contract.title')

                                    </a>
                                </li>

                                <!-- Pension Report -->
                                <li class="{{request()->is('accounts/pensions/monthly-pensions/report/all/show')}}">
                                    <a href="{{route('monthly-pensions.report')}}">
                                        <i class="la la-arrow-circle-o-right"></i>
                                        @lang('accounts::pension.report.title')
                                    </a>
                                </li>

                                <!-- Pension Configuration -->
                                <li class="{{request()->is('accounts/pensions/configurations')}}">
                                    <a href="{{route('pension-configuration.index')}}">
                                        <i class="la la-arrow-circle-o-right"></i>
                                        {{trans('accounts::pension.configuration.short_title')}}
                                    </a>
                                </li>
                                <!-- Pension Configuration -->
                                <li class="{{request()->is(route('pension-nominees.index'))}}">
                                    <a href="{{route('pension-nominees.index')}}">
                                        <i class="la la-arrow-circle-o-right"></i>
                                        {{trans('accounts::pension.nominee.title')}}
                                    </a>
                                </li>

                                <!-- Pension Deduction -->
                                <li class="{{request()->is('accounts/pensions/deductions')}}">
                                    <a href="{{route('pension.deduction.index')}}">
                                        <i class="la la-arrow-circle-o-right"></i>
                                        {{trans('accounts::pension.deduction.title')}}

                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>


                <!-- Sectors -->
                {{--                <li class="nav-item">--}}
                {{--                    <a href="#" class=""><i class="la la-arrow-circle-o-right"></i><span class="menu-title"--}}
                {{--                                                                                         data-i18n="nav.templates.main">{{ trans('accounts::sector.title') }}</span></a>--}}
                {{--                    <ul class="menu-content">--}}
                {{--                        <li>--}}
                {{--                            <a href="#" class=""><i class="la la-arrow-circle-o-right"></i><span--}}
                {{--                                    class="menu-title"--}}
                {{--                                    data-i18n="nav.templates.main">{{ trans('accounts::sector.temporay.title') }}</span></a>--}}

                {{--                            <ul class="menu-content">--}}
                {{--                                <!-- Create Temporary Sectors -->--}}
                {{--                                <li class="{{is_active_route('temporary-sectors.create')}}">--}}
                {{--                                    <a href="{{route('temporary-sectors.create')}}">--}}
                {{--                                        <i class="la la-arrow-circle-o-right"></i>--}}
                {{--                                        <span class="menu-title"--}}
                {{--                                              data-i18n="nav.dash.main">{{ trans('accounts::sector.temporary.create') }}</span>--}}
                {{--                                    </a>--}}
                {{--                                </li>--}}

                {{--                                <!-- Temporary Sectors: index -->--}}
                {{--                                <li class="{{is_active_route('temporary-sectors.index')}}">--}}
                {{--                                    <a href="{{route('temporary-sectors.index')}}">--}}
                {{--                                        <i class="la la-arrow-circle-o-right"></i>--}}
                {{--                                        <span class="menu-title"--}}
                {{--                                              data-i18n="nav.dash.main">{{ trans('accounts::sector.temporary.index') }}</span>--}}
                {{--                                    </a>--}}
                {{--                                </li>--}}

                {{--                            </ul>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}


                {{--                <!-- Report -->--}}


                {{--                <li class="nav-item">--}}
                {{--                    <a href="#" class=""><i class="la la-building"></i><span class="menu-title"--}}
                {{--                                                                             data-i18n="nav.templates.main">Reports</span></a>--}}
                {{--                    <ul class="menu-content">--}}

                {{--                        <!-- Journal Entry -->--}}
                {{--                        <li class="{{is_active_route('journal-entry.index')}}">--}}
                {{--                            <a href="{{route('journal-entry.index')}}">--}}
                {{--                                <i class="la la-arrow-circle-o-right"></i>--}}
                {{--                                <span class="menu-title"--}}
                {{--                                      data-i18n="nav.dash.main">@lang('accounts::configuration.journal.index')</span>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}

                {{--                        --}}{{--                        <!-- Journal Items -->--}}
                {{--                        --}}{{--                        <li class="{{is_active_route('#')}}">--}}
                {{--                        --}}{{--                            <a href="#">--}}
                {{--                        --}}{{--                                <i class="la la-arrow-circle-o-right"></i>--}}
                {{--                        --}}{{--                                <span class="menu-title"--}}
                {{--                        --}}{{--                                      data-i18n="nav.dash.main">Journal Items</span>--}}
                {{--                        --}}{{--                            </a>--}}
                {{--                        --}}{{--                        </li>--}}
                {{--                        --}}{{--                        <!-- General Ledger -->--}}
                {{--                        --}}{{--                        <li class="{{is_active_route('#')}}">--}}
                {{--                        --}}{{--                            <a href="#">--}}
                {{--                        --}}{{--                                <i class="la la-arrow-circle-o-right"></i>--}}
                {{--                        --}}{{--                                <span class="menu-title"--}}
                {{--                        --}}{{--                                      data-i18n="nav.dash.main">General Ledger</span>--}}
                {{--                        --}}{{--                            </a>--}}
                {{--                        --}}{{--                        </li>--}}

                {{--                        --}}{{--                        <!-- Vendor Ledger -->--}}
                {{--                        --}}{{--                        <li class="{{is_active_route('#')}}">--}}
                {{--                        --}}{{--                            <a href="#">--}}
                {{--                        --}}{{--                                <i class="la la-arrow-circle-o-right"></i>--}}
                {{--                        --}}{{--                                <span class="menu-title"--}}
                {{--                        --}}{{--                                      data-i18n="nav.dash.main">Vendor Ledger</span>--}}
                {{--                        --}}{{--                            </a>--}}
                {{--                        --}}{{--                        </li>--}}

                {{--                        --}}{{--                        <!-- Profit and Loss -->--}}
                {{--                        --}}{{--                        <li class="{{is_active_route('#')}}">--}}
                {{--                        --}}{{--                            <a href="#">--}}
                {{--                        --}}{{--                                <i class="la la-arrow-circle-o-right"></i>--}}
                {{--                        --}}{{--                                <span class="menu-title"--}}
                {{--                        --}}{{--                                      data-i18n="nav.dash.main">Profit and Loss</span>--}}
                {{--                        --}}{{--                            </a>--}}
                {{--                        --}}{{--                        </li>--}}

                {{--                        --}}{{--                        <!-- Receipts and Payments -->--}}
                {{--                        --}}{{--                        <li class="{{is_active_route('#')}}">--}}
                {{--                        --}}{{--                            <a href="#">--}}
                {{--                        --}}{{--                                <i class="la la-arrow-circle-o-right"></i>--}}
                {{--                        --}}{{--                                <span class="menu-title"--}}
                {{--                        --}}{{--                                      data-i18n="nav.dash.main">Receipts and Payments--}}
                {{--                        --}}{{--                            </a>--}}
                {{--                        --}}{{--                        </li>--}}


                {{--                    </ul>--}}
                {{--                </li>--}}
                {{--                --}}
            </ul>
        @endauth
    </div>
</div>
