<div class="form-group @if($errors->has($name)) has-error has-feedback @endif">
@if($errors->has($name))
  <div class="col-sm-offset-2 col-sm-10 text-right">{{ $errors->first($name) }}</div>
@endif
  <label for="{{ $name }}" class="control-label col-sm-2">{{ $label }}</label>
  <div class="col-sm-10" @if($errors->has($name)) data-toggle="tooltip" data-placement="top" title="{{ $errors->first($name) }}" @endif>

    @yield('input') 
  
    @if($errors->has($name))
      <span class="glyphicon glyphicon-remove form-control-feedback"></span> 
    @endif
  </div>
</div>