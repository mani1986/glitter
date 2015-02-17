@extends('app')
@section('content')
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <ul class="glitter">
                @foreach ($hashtags as $name => $hits)
                    <li><a href="/h/{{$name}}">{{'#' . $name}}</a> - {{$hits}} glitters</li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-3"></div>
    </div>
@endsection
