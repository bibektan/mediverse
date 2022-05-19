@extends('main.main')
@section('content')


{{-- <form action="{{ route('getBlog') }}" method="POST">
    @csrf
    <div class="form-group">
        <textarea id="welcometextarea" class="form-control" name="blog" rows="25"></textarea>
    </div>
    <div class="form-group">
        <button class="form-control" type="submit">submit</button>
    </div>
</form> --}}



<livewire:blog /> 

@endsection

