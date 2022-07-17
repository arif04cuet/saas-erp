@if($errors->any($key))
    <strong class="danger">{{ $errors->first($key) }}</strong>
@endif