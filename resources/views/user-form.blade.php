@extends('layouts.form')

@section('action', '/user')

@section('fields')
  @include('form-group-text', [
    'name' => 'name',
    'label' => 'Имя',
    'placeholder' => 'Введите имя'
  ])

  @include('form-group-text', [
    'name' => 'balance',
    'label' => 'Баланс',
    'placeholder' => 'Введите исходный баланс'
  ])
@endsection