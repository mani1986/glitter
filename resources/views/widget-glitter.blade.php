<form class="form-horizontal" role="form" method="POST" action="/g/new">
  <textarea class="form-control" name="content" rows="4" placeholder="Glitter"></textarea>
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <button type="submit" class="btn btn-default">Glitter</button>
</form>