@extends('layouts.form-group')

@section('input')
  <input type = "text" name="{{ $name }}" id="{{ $name }}" value="{{ $value or "" }}" class="form-control" placeholder="{{ $placeholder or "" }}">
@overwrite