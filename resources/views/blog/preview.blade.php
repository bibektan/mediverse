@extends('main.main')
@section('content')



@foreach ($data as $k=>$v)
    {!! $v->blog !!}
@endforeach

@endsection
