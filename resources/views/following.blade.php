@extends('app')
@section('content')
    <div class="row">
        <div class="col-md-3">
            @include('widget-user-info')
        </div>
        <div class="col-xs-12 col-md-6">
            <ul class="followers">
            @foreach ($user->following as $follow)
                <li>
                    @include('widget-user-info', ['user' => $follow->follows])
                </li>
            @endforeach
            </ul>
        </div>
        <div class="col-md-3"></div>
    </div>
@endsection