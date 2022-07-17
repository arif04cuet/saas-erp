<select class="form-control {{$class}}" name="{{$name}}">
    {!! $options !!}
</select>

@if ($errors->has($name))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first($name) }}</strong>
    </span>
@endif