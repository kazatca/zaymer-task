@extends('layouts.form-group')

@section('input')
  <select class="form-control" name="{{ $name }}" id ="{{ $name }}" >
    <option value="" selected disabled>{{ $placeholder or "..." }}</option>
    @foreach($options as $option)
      <option value="{{ $option['id'] }}" >{{ $option['value'] }}</option>
    @endforeach 
  </select>
@overwrite
