@extends('layouts.front-master')
@section('content')

<!------------ Search List Start ---------------->
<div class="container mt-2">
    <div class="row ng-scope">
        {{-- <div class="col-md-3 col-md-push-9">
            <h4>Results <span class="fw-semi-bold">Filtering</span></h4>
            <p class="text-muted fs-mini">Listed content is categorized by the following groups:</p>
            <ul class="nav nav-pills nav-stacked search-result-categories mt">
                <li><a href="#">Friends <span class="badge">34</span></a>
                </li>
                <li><a href="#">Pages <span class="badge">9</span></a>
                </li>
                <li><a href="#">Images</a>
                </li>
                <li><a href="#">Groups</a>
                </li>
                <li><a href="#">Globals <span class="badge">18</span></a>
                </li>
            </ul>
        </div> --}}
        <div class="col-md-12 col-md-pull-3">
            <h2 class="search-results-count pt-2 pb-2">About 1 (0.39 sec.) results</h2>
            @if(count($courseData) == 0)
            <section class="search-result-item">
                <div class="search-result-item-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2 class="text-center">Data not found!</h2>
                        </div>
                    </div>
                </div>
            </section>
            @else
            @foreach($courseData as $key => $course)
            <section class="search-result-item">
                <a class="image-link" href="#"><img class="image" src="https://via.placeholder.com/150">
                </a>
                <div class="search-result-item-body">
                    <div class="row">
                        <div class="col-sm-9">
                            <h4 class="search-result-item-heading"><a href="#">{{ $course->name }}</a></h4>
                            <p class="info">Start Date: {{ date('d-m-Y',strtotime($course->start_date)) }}</p>
                            <p class="info">End Date: {{ date('d-m-Y',strtotime($course->end_date)) }}</p>
                            {{-- <p class="description">Not just usual Metro. But something bigger. Not just usual widgets, but real widgets. Not just yet another admin template, but next generation admin template.</p> --}}
                        </div>
                        <div class="col-sm-3 text-align-center">
                            {{-- <p class="value3 mt-sm">$9, 700</p>
                            <p class="fs-mini text-muted">PER WEEK</p><a class="btn btn-primary btn-info btn-sm" href="#">Learn More</a> --}}
                        </div>
                    </div>
                </div>
            </section>
            @endforeach
            @endif
            {{-- @endif --}}
            {{-- <div class="text-align-center">
                <ul class="pagination pagination-sm">
                    <li class="disabled"><a href="#">Prev</a>
                    </li>
                    <li class="active"><a href="#">1</a>
                    </li>
                    <li><a href="#">2</a>
                    </li>
                    <li><a href="#">3</a>
                    </li>
                    <li><a href="#">4</a>
                    </li>
                    <li><a href="#">5</a>
                    </li>
                    <li><a href="#">Next</a>
                    </li>
                </ul>
            </div> --}}
        </div>
    </div>
</div>
<!------------ Search List End ---------------->

<script>

</script>
@endsection

@stack('page-js')

