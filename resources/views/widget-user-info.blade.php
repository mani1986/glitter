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
            @if (!Auth::guest() && $user->id != Auth::id())
                <li>
                    @if (!$user->getIsBeingFollowed())
                        <button type="button" class="btn btn-default btn-follow" aria-label="Left Align">
                            <a href="/u/{{$user->username}}/follow">Follow</a>
                        </button>
                    @else
                        <button type="button" class="btn btn-default btn-unfollow" aria-label="Left Align">
                            <a href="/u/{{$user->username}}/unfollow">Unfollow</a>
                        </button>
                    @endif
                </li>
            @endif
        </ul>
    </div>
    <div class="user-table">
        <ul class="user-statistics">
            <li>
                <span class="title">Following</span>
                <span><a href="/u/{{$user->username}}/following">{{$user->getNumberOfFollowing()}}</a></span>
            </li>
            <li>
                <span class="title">Followers</span>
                <span><a href="/u/{{$user->username}}/followers">{{$user->getNumberOfFollowers()}}</a></span>
            </li>
            <li>
                <span class="title">Glitters</span>
                <span>{{$user->getNumberOfGlitters()}}</span>
            </li>
        </ul>
    </div>
</div>