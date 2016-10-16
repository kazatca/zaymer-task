<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TransferTest extends TestCase{


  /**
   * стоит использовать DatabaseTransactions 
   * дабы не плодить пользователей в setUp
   */
  use DatabaseMigrations;  
  
  public function setUp(){
    parent::setUp();
    //создаем двух пользователей и записываем их
    $this->users = factory(\App\User::class, 2)->create();
  }

  public function testAddTransfer(){
    $users = factory(\App\User::class, 2)->create();

    $this->visit('/')
      ->select(1, 'from')  //выбираем первого пользователя в поле отправитель
      ->select(2, 'to')    //выбираем второго пользователя в поле получатель
      ->type(10, 'volume') //переводим 10.00 
      ->press('submit')    //отправляем форму
      // ->see($users[0]->name)  // не показатель, т. к. имена есть в форме 
      // ->see($users[1]->name)
      ->see('10.00');      //в результате должно встретится 10.00
  }

  public function testAddTransferWithoutVolume(){
    $users = factory(\App\User::class, 2)->create();

    $this->visit('/')
      ->select(1, 'from')
      ->select(2, 'to')
      // ->type(10, 'volume') //оставляем поле сумма пустым
      ->press('submit')
      ->see(trans('validation.required', ['attribute' => 'volume'])); 
  }

  public function testAddTransferWithVolumeZero(){
    $users = factory(\App\User::class, 2)->create();
    
    $this->visit('/')
      ->select(1, 'from')
      ->select(2, 'to')
      ->type(0, 'volume')  //в поле сумма вводим 0
      ->press('submit')
      ->see(trans('validation.min.numeric', ['attribute'=>'volume', 'min' => '0.01']));
  }

  public function testAddTransferWithoutSender(){
    $users = factory(\App\User::class, 2)->create();
    
    $this->visit('/')
      // ->select(1, 'from') //не выбираем отправителя
      ->select(2, 'to')
      ->type(10, 'volume')
      ->press('submit')
      ->see(trans('validation.required', ['attribute' => 'from']));
  }

  public function testAddTransferSenderEqRecipient(){
    $users = factory(\App\User::class, 2)->create();
    

    $this->visit('/')
      ->select(1, 'from')
      ->select(1, 'to')  //отправитель и получатель - один и тот же пользователь
      ->type(10, 'volume')
      ->press('submit')
      ->see(trans('validation.different', ['attribute' => 'from', 'other' => 'to']));
  }


}
