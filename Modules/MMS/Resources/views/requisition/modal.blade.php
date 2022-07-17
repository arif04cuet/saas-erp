
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
{{-- <form class="form" id="upload_form" method="POST" action="" enctype="multipart/form-data">--}}
 <form class="form" id="upload_form" method="POST" action="{{ route('inventories.prescribed.acknowledgement') }}" enctype="multipart/form-data">
            <div class="modal-header">
                <h4 class="modal-title">{{trans('mms::medicine_distribution.attachment')}}</h4>
            </div>
            <div class="modal-body">
                <input class="form-control" name="id" type="hidden" id="acknowledgement_slip_id">
                @csrf
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>@lang('mms::medicine_distribution.image_size')</label>
                       <input class="form-control" accept=".png, .jpg, .jpeg" name="photo" type="file">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="submit" class="btn btn-primary">
                    <i class="ft-check-square "></i> {{ trans('labels.save') }}
                </button>
                <button class="btn btn-warning" type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="ft-x"></i> {{ trans('labels.cancel') }}
                </button>
            </div>
            </form>
            <span id="uploaded_image"></span>
        </div>

    </div>
</div>

