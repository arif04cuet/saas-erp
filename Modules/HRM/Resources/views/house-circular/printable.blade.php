<style>
    .report {
        border-collapse: collapse;
        width: 96%;
        text-align: center;
        margin-left: 10px;
        margin-right: 5px;
        font-size: 9px;
    }

    .report td,
    th {
        border: 1px solid gray;
    }

    table.print-friendly tr td,
    table.print-friendly tr th {
        page-break-inside: avoid !important;
    }

    .d-flex {
        display: flex !important;
    }
    .justify-content-between {
        justify-content: space-between !important;
    }
    .flex-row {
        flex-direction: row !important;
    }
    .ml-2 {
        margin-left: 16px;
    }
    .ml-4 {
        margin-left: 32px;
    }
    .mt-1 {
        margin-top: 16px;
    }
    .text-center {
        text-align: center;
    }
    .circular {
        border-bottom: 2px solid black;
        width: 10%;
        margin-left: auto;
        margin-right: auto;
    }
</style>
<center>
    <strong style="font-size: 16px;">{{__('labels.bard_title')}}</strong><br>
    <strong style="font-size: 12px;">@lang('labels.bard_address.kotbari'),
    @lang('labels.bard_address.address')</strong><br>
</center>
<br>
<div class="card">
    <div class="card-content">
        <div class="card-body">
            <div class="d-flex justify-content-between mt-1">
                <div class="d-flex flex-row">
                    <p>@lang('hrm::house-circular.reference_no') - </p>
                    <p class="ml-2">{{ $circular->reference_no }}</p>
                </div>
                <div class="d-flex flex-row">
                    <p>@lang('hrm::house-circular.last_date') - </p>
                    <p class="ml-2">{{\App\Utilities\EnToBnNumberConverter::en2bn(date('d', strtotime($circular->apply_to))) .
                        ' ' . \App\Utilities\MonthNameConverter::convertMonthToBn($circular->apply_to) }}</p>
                </div>
            </div>
            <h3 class="text-center circular">বিজ্ঞপ্তি</h3>
            <p class="ml-2"><span class="ml-4"></span>একাডেমীর নিম্নে খালি বাসাসমুহ বরাদ্দ প্রদানের লক্ষ্যে বার্ড-এ কর্মরত আগ্রহী কর্মকর্তা-কর্মচারীগনের  নিকট হতে সংস্থাপন শাখার নির্দিষ্ট ফরমে দরখাস্ত আহ্বান করা যাচ্ছে ঃ </p>
            <div>
                <table class="report print-friendly">
                    <thead>
                        <th>@lang('labels.serial')</th>
                        <th>@lang('hrm::house-details.house_type')</th>
                        <th>@lang('hrm::house-details.house_id')</th>
                        <th>@lang('hrm::house-circular.designation_level')</th>
                        <th>@lang('hrm::house-circular.salary_grade')</th>
                    </thead>
                    <tbody>
                        @foreach ($circular->circularCategories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->category->name }}</td>
                                <td>
                                    @foreach ($category->circularHouses as $house)
                                        {{ $house->house->house_id }} @if (!$loop->last),@endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($category->circularDesignations as $designation)
                                        {{ $designation->designation->getName() }} @if (!$loop->last),@endif
                                    @endforeach
                                </td>
                                <td>{{ $category->category->eligible_from . ' - ' . $category->category->eligible_to }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <p class="ml-2"><span class="ml-4"></span>আগ্রহী প্রার্থীকে আগামী {{\App\Utilities\EnToBnNumberConverter::en2bn(date('d', strtotime($circular->apply_to))) .
                ' ' . \App\Utilities\MonthNameConverter::convertMonthToBn($circular->apply_to) }} তারিখের মধ্যে নিম্নসাক্ষরকারী বরাবর আবেদন করার জন্য অনুরোধ করা হল। নির্ধারিত তারিখের পর কোনো আবেদন পত্র গ্রহণ করা হবে না।</p>
        </div>
    </div>
</div>