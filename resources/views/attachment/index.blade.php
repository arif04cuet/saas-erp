@extends('layouts.master')
@section('title', trans('labels.User list'))

@section('content')
    @if(isset($path))
        <h3>{{$path}}</h3>
    @endif
    @if(isset($url))
        <h3>{{$url}}</h3>
    @endif
    <form method="post" action="{{route('test.upload')}}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="test_attachment" />
        <input type="submit" value="Submit"/>
    </form>
@endsection
