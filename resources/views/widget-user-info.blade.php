<div class="media">
  <div class="media-left">
    <div class="avatar" style="background: url('data:{{$user->avatar}}')"></div>
  </div>
  <div class="media-body">
    <ul class="user-info">
        <li>
            {{$user->name}}
        </li>
        <li>
            {{'@' . $user->username}}
        </li>
        <li>
            Following: <a href="/u/{{$user->username}}/following">{{$user->getNumberOfFollowing()}}</a>
        </li>
        <li>
            Followers: <a href="/u/{{$user->username}}/followers">{{$user->getNumberOfFollowers()}}</a>
        </li>
        <li>
            Glitters: {{$user->getNumberOfGlitters()}}
        </li>
        @if (!Auth::guest() && $user->id != Auth::id())
            <li>
                @if (!$user->getIsBeingFollowed())
                    <button type="button" class="btn btn-default" aria-label="Left Align">
                        <a href="/u/{{$user->username}}/follow">Follow</a>
                    </button>
                @else
                    <button type="button" class="btn btn-default" aria-label="Left Align">
                        <a href="/u/{{$user->username}}/unfollow">Unfollow</a>
                    </button>
                @endif
            </li>
        @endif
    </ul>
  </div>
</div>