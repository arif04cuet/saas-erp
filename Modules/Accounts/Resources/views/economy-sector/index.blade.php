@extends('accounts::layouts.master')
@section('title',trans('accounts::accounts.sector.title'))
@section('content')
    <section id="room-type-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('accounts::accounts.sector.title') @lang('labels.list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{url(route('economy-sectors.create'))}}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i>@lang('labels.new') @lang('accounts::accounts.sector.title')
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table id="room-type" class="table table-striped table-bordered alt-pagination">
                                <thead>
                                <tr>
                                    <th width="5%">@lang('labels.serial')</th>
                                    <th>@lang('accounts::accounts.sector.parent_code')</th>
                                    <th>@lang('labels.code')</th>
                                    <th width="25%">@lang('labels.title') (English)</th>
                                    <th width="25%">@lang('labels.title') (বাংলা)</th>
                                    <th>@lang('labels.description')</th>
                                    <th width="15%">@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($economySectors as $sector)
                                    @php
                                        $economyCode = $sector->economyCode;
$title = $economyCode ? (\Illuminate\Support\Facades\App::getLocale() == 'bn')?
\App\Utilities\EnToBnNumberConverter::en2bn($economyCode->code, false).' - '.$economyCode->bangla_name :
$economyCode->code.' - '.$economyCode->english_name : __('labels.not_found');
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{$title}}</td>
                                        <td>{{$sector->code}}</td>
                                        <td>{{$sector->title}}</td>
                                        <td>{{$sector->title_bangla}}</td>
                                        <td>{{$sector->description}}</td>
                                        <td>
                                            <a href="{{ route('economy-sectors.edit', $sector->id) }}"
                                               class="btn btn-primary btn-sm">
                                                <i class="la la-pencil-square"></i>
                                            </a>
                                            {!! Form::open([
                                                    'method'=>'DELETE',
                                                    'url' => route('economy-sectors.destroy', $sector->id),
                                                    'style' => 'display:inline'
                                                    ]) !!}
                                            {!! Form::button('<i class="la la-trash-o"></i>', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => 'Delete Economy Code',
                                            'onclick'=> 'return confirm("Confirm delete?")',
                                            )) !!}
                                            {!! Form::close() !!}

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
    </section>
@endsection

