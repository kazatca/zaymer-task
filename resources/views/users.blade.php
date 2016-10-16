@extends('layouts.app')

@section('title', 'Пользователи')

@section('content')

  <div class="well">
    <h2>Новый пользователь</h2>
    @include('users-form')
  </div>
  

  <table class="table table-striped">
    <thead>
      <tr>
        <th>Имя</th>
        <th>Баланс</th>
      </tr>
    </thead>
      
    @foreach($users as $user)
    <tr>
      <td>{{$user->name}}</td>
      <td>{{$user->balance}}</td>
    </tr>
    @endforeach 
  </table>

@endsection