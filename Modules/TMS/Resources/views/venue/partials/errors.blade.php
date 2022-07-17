<div class="help-block"> </div>
@if( $errors->has($name))
    <span class="invalid-feedback" role="alert">
        <strong>
            {{ $errors->first( $name ) }}
        </strong>
    </span>
@endif