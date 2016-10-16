<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Transfer;


class Transfers extends Controller{
  
  /**
   * Выводит все перечисления средств
   * @param  Request $request запрос
   * @return View  отображение
   */
  public function show(Request $request){

    $transfers = \DB::table('transfers')
      ->select('user_from.name as from', 'user_to.name as to', 'transfers.volume')
      ->join('users as user_from', 'user_from.id', '=', 'transfers.from')
      ->join('users as user_to', 'user_to.id', '=', 'transfers.to')
      ->get();

    //пользователи в виде ключ->значение для шаблона select
    $users = User::all();
    $users = array_map(function($user){
      return [
        'id'    => $user->id,
        'value' => $user->name
      ];
    }, iterator_to_array($users) );

    return view('transfers', [
      'users' => $users,
      'transfers' => $transfers
    ]);

  }

  /**
   * Добавляет новое перечисление
   * @param Request $request [description]
   */
  public function add(Request $request){
    
    $validator = \Validator::make($request->all(), [
      //поле отправитель должно отличаться от поля получатель
      'from' => 'required|different:to', 
      'to' => 'required',
      'volume' => 'required|numeric|min:0.01'
    ]);

    if ($validator->fails()) {
      //данные не валидны, возвращаем ошибки
      return redirect('/')
        ->withInput()
        ->withErrors($validator);
    }

    //добавляем перечисление

    $transfer = new Transfer;

    $transfer->from = $request->from;
    $transfer->to = $request->to;
    $transfer->volume = $request->volume;
    $transfer->save();

    return redirect('/');
  }
}
