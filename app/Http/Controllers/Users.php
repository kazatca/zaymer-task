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
        ->withInput()
        ->withErrors($validator);
    }

    $user = new User;
    $user->name = $request->name;
    $user->setBalance($request->balance);
    $user->save();

    return redirect('/users');
    
  }

  public function show(){
    $users = User::all();
    
    return view('users', [
      'users' => $users
    ]);    
  }
}
