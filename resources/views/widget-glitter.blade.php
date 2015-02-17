<form class="form-horizontal" role="form" method="POST" action="/g/new">
    <div class="col-sm-10">
        <textarea class="form-control col-sm-10" name="content" rows="4" placeholder="Glitter" required="required" pattern=".{15,}" title="15 characters minimum"></textarea>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </div>
    <div class="col-sm-2">
        <button type="submit" class="btn btn-default btn-glitter">Glitter</button>
    </div>
</form>