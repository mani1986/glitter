@extends('app')
@section('content')
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <h2>Latest glitters</h2>
            <ul class="glitter">
                @foreach ($glitters as $glitter)
                    @include('glitter-single')
                @endforeach
            </ul>
        </div>
        <div class="col-md-3"></div>
    </div>
@endsection