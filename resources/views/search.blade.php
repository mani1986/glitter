@extends('app')
@section('content')
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form class="form-inline" method="POST">
                <div class="form-group">
                    <input type="text" class="form-control" name="search" placeholder="Search">
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-default">Search</button>
            </form>

            @if ($result === true)
                @if (count($glitters))
                    <h3>Glitters:</h3>
                    <ul class="glitter">
                        @foreach ($glitters as $glitter)
                            @include('glitter-single')
                        @endforeach
                    </ul>
                @endif

                @if (count($users))
                    <h3>Users:</h3>
                    @foreach ($users as $user)
                        <div><a href="/u/{{$user->username}}">{{$user->name}}</a></div>
                    @endforeach
                @endif

                @if (!count($glitters) && !count($users))
                    <p>No results found.</p>
                @endif
            @endif
        </div>
        <div class="col-md-3"></div>
    </div>
@endsection