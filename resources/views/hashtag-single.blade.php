@extends('app')
@section('content')
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <h2>Glitters with {{'#' . $name}}</h2>
            <ul class="glitter">
                @foreach ($hashtags as $hashtag)
                    @include('glitter-single', ['glitter' => $hashtag->linked_glitter])
                @endforeach
            </ul>
        </div>
        <div class="col-md-3"></div>
    </div>
@endsection