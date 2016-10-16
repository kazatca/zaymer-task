<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TransferTest extends TestCase{

  use DatabaseMigrations;

  /**
   * A basic test example.
   *
   * @return void
   */
  public function testAddTransfer(){
    $users = factory(\App\User::class, 2)->create();

    $this->visit('/')
      ->select(1, 'from')
      ->select(2, 'to')
      ->type(10, 'volume')
      ->press('submit')
      ->see($users[0]->name)
      ->see($users[1]->name)
      ->see('10.00');
  }

  public function testAddTransferWithoutVolume(){
    $users = factory(\App\User::class, 2)->create();
    

    $this->visit('/')
      ->select(1, 'from')
      ->select(2, 'to')
      // ->type(10, 'volume')
      ->press('submit')
      ->see(trans('validation.required', ['attribute' => 'volume']));
  }

  public function testAddTransferWithVolumeZero(){
    $users = factory(\App\User::class, 2)->create();
    

    $this->visit('/')
      ->select(1, 'from')
      ->select(2, 'to')
      ->type(0, 'volume')
      ->press('submit')
      ->see(trans('validation.min.numeric', ['attribute'=>'volume', 'min' => '0.01']));
  }

  public function testAddTransferWithoutSender(){
    $users = factory(\App\User::class, 2)->create();
    

    $this->visit('/')
      // ->select(1, 'from')
      ->select(2, 'to')
      ->type(10, 'volume')
      ->press('submit')
      ->see(trans('validation.required', ['attribute' => 'from']));
  }

  public function testAddTransferSenderEqRecipient(){
    $users = factory(\App\User::class, 2)->create();
    

    $this->visit('/')
      ->select(1, 'from')
      ->select(1, 'to')
      ->type(10, 'volume')
      ->press('submit')
      ->see(trans('validation.different', ['attribute' => 'from', 'other' => 'to']));
  }


}
