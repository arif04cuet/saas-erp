{!! Form::open(['route' =>  'finish-foods.filter', 'id' =>'finish-food-form','class' => 'form novalidate']) !!}

<h4 class="form-section"><i class="la la-tag"></i>@lang('cafeteria::finish-food.title')</h4>
<div class="row">

    <!-- Food Menu -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('food_menu_id',
                     trans('cafeteria::food-menu.title'),
                    ['class' => 'form-label ']) !!}

            {!! Form::select('food_menu_id', $foodMenus, null,
                [ 'class'=>'form-control select2',
                  'placeholder'=>trans('labels.all')])  !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <div style="margin-top: 2rem !important">
                <!-- Search Button -->
                <a class="ft ft-search btn btn-success" id="search">
                    @lang('cafeteria::cafeteria.search')
                </a>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}