<!-- Button trigger modal -->
<button type="button" class="float-right btn btn-sm btn-outline-primary" data-toggle="modal"
        data-target="#default">
    <i class="ft-plus"></i>
    Add room information
</button>
<!-- Modal -->
<div class="modal fade text-left" id="default" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel1"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Room Information</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="#">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="room_type" class="form-label">Room Type</label>
                            <select class="form-control" name="room_type" id="">
                                <option selected disabled="">Select room type</option>
                                @foreach($hostel->roomTypes as $roomType)
                                    <option value="{{ $roomType->id }}">{{ $roomType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <u>Room Items</u>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <div class="row">
                                <div class="col-md-5">Item Name</div>
                                <div class="col-md-5">Quantity</div>
                            </div>
                            <div class="repeater-default">
                                <div data-repeater-list="inventories">
                                    <div data-repeater-item>
                                        <div class="row">
                                            <div class="form-group- col-md-5">
                                                <input name="name" type="text"
                                                       class="form-control">
                                            </div>
                                            <div class="form-group- col-md-5">
                                                <input name="quantity" type="number" min="1"
                                                       class="form-control">
                                            </div>
                                            <div class="form-group- col-md-2">
                                                <button data-repeater-delete type="button"
                                                        class="btn btn-outline-danger"><i
                                                            class="ft-x"></i></button>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                <div class="form-group overflow-hidden">
                                    <div class="col-12">
                                        <button type="button" data-repeater-create
                                                class="btn btn-primary btn-sm">
                                            <i class="ft-plus"></i> Add more item
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary"
                        data-dismiss="modal">Close
                </button>
                <button type="button" class="btn btn-outline-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}" type="text/javascript"></script>
<script>
    function toggleRoomCheckboxes() {
        let roomCheckboxes = $('input[name="level[]"]');
        roomCheckboxes.attr('checked', !roomCheckboxes.attr('checked'));
    }

    $(document).ready(function () {
        let modal = $('#default');
        modal.on('hidden.bs.modal', function (e) {
            modal.find('form')[0].reset();
            $('div[data-repeater-item]:not(:first)').remove();
        });
    });
</script>