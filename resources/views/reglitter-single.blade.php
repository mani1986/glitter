<li>
    <div class="avatar" style="background-image: url('data:{{$glitter->author->avatar}}')"></div>
    <h4>
        <a href="/u/{{$glitter->author->username}}">{{$glitter->author->name}}</a> <small>reglittered {{$glitter->created_at}}</small>
    </h4>
    <div class="avatar-small" style="background-image: url('data:{{$glitter->reglitter_link->author->avatar}}')"></div>
    <h3>
        <a href="/u/{{$glitter->reglitter_link->author->username}}">{{$glitter->reglitter_link->author->name}}</a> <small>{{'@' . $glitter->reglitter_link->author->username}} - {{$glitter->reglitter_link->created_at}}</small>
    </h3>
    <p>{!!$glitter->reglitter_link->getParsedContent()!!}</p>
</li>