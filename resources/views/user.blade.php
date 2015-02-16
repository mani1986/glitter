@extends('app')
@section('content')
    <div class="row">
        <div class="col-md-3">
            @include('widget-user-info')
        </div>
        <div class="col-md-6">
            <ul class="glitter">
            @foreach ($user->feed as $glitter)
                @include('glitter-single')
            @endforeach
            </ul>
        </div>
        <div class="col-md-3"></div>
    </div>
@endsection