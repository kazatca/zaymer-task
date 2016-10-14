<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use App\User;
use App\Transfer;
use Illuminate\Http\Request;

Route::get('/', function () {
  $users = User::all();
  $transfers = Transfer::all();

  return view('transfers',[
      'users' => $users,
      'transfers' => $transfers
    ]);
});


Route::get('/users', function(){

  $users = User::all();
  return view('users', [
    'users' => $users
  ]);
});

Route::post('/user', function(Request $request){

  $validator = Validator::make($request->all(), [
    'name' => 'required|max:255',
    'balance' => 'numeric'
  ]);
  
  if ($validator->fails()) {
    return redirect('/users')
      ->withInput()
      ->withErrors($validator);
  }

  $user = new User;
  $user->name = $request->name;
  $user->balance = $request->balance;
  $user->save();

  return redirect('/users');
});

Route::post('/transfer', function(Request $request){
  $validator = Validator::make($request->all(), [
    'from' => 'required',
    'to' => 'required',
    'volume' => 'min:0'
  ]);

  if ($validator->fails()) {
    return redirect('/')
      ->withInput()
      ->withErrors($validator);
  }

  $transfer = new Transfer;

  $transfer->from = $request->from;
  $transfer->to = $request->to;
  $transfer->volume = $request->volume;
  $transfer->save();

  return redirect('/');


});
