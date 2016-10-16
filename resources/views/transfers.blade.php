@extends('layouts.app')

@section('title', 'Переводы')


@section('content')

  <div class="well">
    <h2>Новый перевод</h2>
    @include('transfers-form')

  </div>

  <table class="table table-striped">
  <thead>
    <tr>
      <th>Отправитель</th>
      <th>Сумма</th>
      <th>Получатель</th>
    </tr>
  </thead>
  @foreach($transfers as $transfer)
  <tr>
    <td >{{$transfer->from}}</td>
    <td >{{$transfer->volume}}</td>
    <td >{{$transfer->to}}</td>
  </tr>
  @endforeach
@endsection
