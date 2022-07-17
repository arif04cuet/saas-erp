@foreach($employee->employeePublicationInfo as $publication)
    <table class="table">
        <tbody>
        <tr>
            <th scope="col">@lang('hrm::publication.type_of_publication')</th>
            <td>{{$publication->type_of_publication}}</td>
        </tr>
        <tr>
            <th scope="col">@lang('hrm::publication.author_name')</th>
            <td>{{$publication->author_name}}</td>
        </tr>
        <tr>
            <th scope="col">@lang('hrm::publication.publication_title')</th>
            <td>{{$publication->publication_title}}</td>
        </tr>
        <tr>
            <th scope="col">@lang('hrm::publication.publication_company')</th>
            <td>{{$publication->publication_company}}</td>
        <tr>
            <th scope="col">@lang('hrm::publication.publication_company_location')</th>
            <td>{{$publication->publication_company_location}}</td>
        </tr>
        <tr>
            <th scope="col">@lang('hrm::publication.published_date')</th>
            <td>@if(!empty($publication->published_date)) {{date('d F, Y', strtotime($publication->published_date))}} @endif </td>
        </tr>
        <tr>
            <th scope="col">@lang('hrm::publication.published_source_link')</th>
            <td><a href="{{$publication->source_link}}" target="_blank">{{$publication->source_link}}</a> </td>
        </tr>

        </tbody>
    </table>
@endforeach
<a class="btn btn-small btn-info" href="{{ url('/hrm/employee/' . $employee->id . '/edit#publication') }}">@lang('labels.edit') </a>