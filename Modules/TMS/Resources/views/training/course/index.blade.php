@component('tms::training.partials.components.show_layout', ['training' => $training])

    <section id="assessment">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
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
                            <!-- nav tabs -->
                        {{-- @include('tms::training.course.partial.layout.nav_tabs') --}}
                        <!-- / end of nav tabs-->
                            <div class="tab-content px-1 pt-1">
                                <div role="tabpanel"
                                     class="tab-pane active">
                                    <!-- views are injected in the slot -->
                                    {{-- {{ $slot }} --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endcomponent
