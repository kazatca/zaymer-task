@extends('layouts.form')

@section('action', '/transfer')

@section('submitCaption', 'Перевести')

@section('fields')

  @include('form-group-select', [
    'name' => 'from',
    'label' => 'Отправитель',
    'options' => $users,
    'placeholder' => 'Выберите отправителя'
  ])

  @include('form-group-text', [
    'name' => 'volume',
    'label' => 'Сумма',
    'placeholder' => 'Сумма перевода'
  ])

  @include('form-group-select', [
    'name' => 'to',
    'label' => 'Получатель',
    'options' => $users,
    'placeholder' => 'Выберите получателя'
  ])
  
@endsection