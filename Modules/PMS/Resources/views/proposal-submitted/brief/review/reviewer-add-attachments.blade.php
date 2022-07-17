<div class="row">
    {!! Form::open(['route'=> 'project.proposal.reviewer.add.attachment', 'class' => 'form', 'novalidate', 'enctype' => 'multipart/form-data']) !!}
    {!! Form::hidden('project_proposal_submission_id', $proposal->id) !!}
    <div class="col-12 offset-sm-1">
        {{ Form::label('attachments', trans('pms::reviewer-add-attachments.title')) }}
        {{ Form::file('attachments[]', ['class' => 'form-control' . (($errors->has('attachments') || $errors->has('attachments.*')) ? ' is-invalid ' : '') . ' required', 'accept' => '.doc, .docx, .xlx, .xlsx, .csv, .pdf', 'multiple' => 'multiple']) }}
        <div class="help-block"></div>
        @if($errors->has('attachments'))
            <span class="invalid-feedback">{{ $errors->first('attachments') }}</span>
        @endif
        @if($errors->has('attachments.*'))
            @foreach($errors->all() as $key => $error)
                @if($errors->has('attachments.'. $key))
                    <span class="invalid-feedback">{{ $errors->first('attachments.' . $key) }}</span>
                @endif
            @endforeach
        @endif
    </div>
    <div class="col-12 mt-lg-1 offset-sm-1">
        <div class="">
            {!! Form::button('<i class="la la-check"></i> '. __('pms::reviewer-add-attachments.buttons.upload.title') , ['type' => 'submit', 'class' => 'btn btn-primary btn-sm', 'name' => 'type', 'value' => 'publish'] ) !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>