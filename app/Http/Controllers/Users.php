<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;


class Users extends Controller{
  public function add(Request $request){
    $validator = \Validator::make($request->all(), [
      'name' => 'required|max:255',
      'balance' => 'numeric'
    ], [
      'required' => 'Поле не может быть пустым'
    ]);
    
    if ($validator->fails()) {
      return redirect('/users')
        // ->withInput()
        ->withErrors($validator);
    }

    $user = new User;
    $user->name = $request->name;
    if($request->balance){
      $user->balance = $request->balance;
    }
    $user->save();

    return redirect('/users');
    
  }

  public function show(){
    $users = User::all();


    /*
    select tmp.id, sum(tmp.volume) from (select u.id id, case when t.from=u.id then -t.volume else t.volume end as volume from users u join transfers t on t.from = u.id or t.to=u.id union select u.id id, u.balance as volume from users u) tmp group by 1;
    
     */
    
    return view('users', [
      'users' => $users
    ]);    
  }
}
