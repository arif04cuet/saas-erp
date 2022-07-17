<div class="row">
    <div class="col-md-12 mt-2">
        <div id="testTable" class="table-responsive form-group">
            <table class="table table-bordered repeater-test">
                <thead>
                <tr>
                    <th width="98%">Test</th>
                    <th class="text-center" style="width: 2%">
                        <i data-repeater-create class="la la-plus-circle text-info cursor-pointer"></i>
                    </th>
                </tr>
                </thead>
                <tbody data-repeater-list="test">
                @if(empty($test))
                @foreach($test as $testInfo)
                    <tr data-repeater-item id="ID-{{$testInfo->id}}">
                        <td>
                            <input class="form-control required test_id" name="id" type="hidden"
                                   value="{{$testInfo->id}}">
                            <input class="form-control required" name="test_name" type="text" placeholder="Name"
                                   value="{{$testInfo->test_name}}">
                        </td>
                        <td class="text-center align-middle">
                            <i data-repeater-delete class="la la-trash-o text-danger cursor-pointer"></i>
                        </td>
                    </tr>
                @endforeach
                @else
                    <tr data-repeater-item>
                        <td><input class="form-control required" name="test_name" type="text" placeholder="Name"></td>
                        <td class="text-center align-middle">
                            <i data-repeater-delete class="la la-trash-o text-danger cursor-pointer"></i>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
