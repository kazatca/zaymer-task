<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Transfer;


// use App\Http\Requests;

class Transfers extends Controller{
    
  public function show(Request $request){
    $users = User::all();

    $transfers = \DB::table('transfers')
      ->select('user_from.name as from', 'user_to.name as to', 'transfers.volume')
      ->join('users as user_from', 'user_from.id', '=', 'transfers.from')
      ->join('users as user_to', 'user_to.id', '=', 'transfers.to')
      ->get();

    $users = array_map(function($user){
      return [
        'id'    => $user->id,
        'value' => $user->name
      ];
    }, iterator_to_array($users) );

    return view('transfers',[
      'users' => $users,
      'transfers' => $transfers
    ]);

  }

  public function add(Request $request){
    $validator = \Validator::make($request->all(), [
      'from' => 'required',
      'to' => 'required',
      'volume' => 'required|min:0.01'
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
  }
}
