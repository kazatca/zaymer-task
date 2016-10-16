<form action='@yield('action')', method="POST" class="form-horizontal">

  <input type="hidden" name="_token" value="{{ csrf_token() }}">

  @yield('fields')  

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" value="@yield('submitCaption', 'Отправить')" name="submit" class="btn btn-default">
    </div>
  </div>
</form>
