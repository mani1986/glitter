@if (!$glitter->reglitter)
<li>
    <div class="avatar" style="background: url('data:{{$glitter->author->avatar}}')"></div>
    <h3>
        <a href="/u/{{$glitter->author->username}}">{{$glitter->author->name}}</a> <small>{{'@' . $glitter->author->username}} at {{$glitter->created_at}}</small>
    </h3>
    <p>{!!$glitter->getParsedContent()!!}</p>
    @if (Auth::check() && $glitter->author->id !== Auth::id())
        <p><a href="/g/{{$glitter->id}}/reglitter">Reglitter</a></p>
    @endif
    @if (Auth::check() && $glitter->author->id === Auth::id())
        <p><a href="/g/{{$glitter->id}}/delete">Delete</a></p>
    @endif
</li>
@else
    @include('reglitter-single')
@endif