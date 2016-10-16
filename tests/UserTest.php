<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase{

  use DatabaseMigrations;

  public function testNameAndBalance(){

    $this->visit('/users')
      ->type('Alice', 'name')  //вводим имя
      ->type(10, 'balance')    //вводим баланс
      ->press('submit')        //отправляем форму
      ->see('Alice')           //на странице должны встретиться новое имя 
      ->see('10.00');          //и баланс
  }

  public function testNameOnly(){
    $this->visit('/users')
      ->type('Alice', 'name') //вводим только имя
      ->press('submit')
      ->see('Alice')
      ->see('0.00');          //на странице должен быть баланс по-умолчанию

  }
}
