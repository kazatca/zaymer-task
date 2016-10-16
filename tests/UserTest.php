<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase{

  use DatabaseMigrations;
  /**
   * A basic test example.
   *
   * @return void
   */
  public function testNameAndBalance(){
    $this->visit('/users')
      ->type('Alice', 'name')
      ->type('10', 'balance')
      ->press('submit')
      ->see('Alice')
      ->see('10.00');
  }

  public function testNameOnly(){
    $this->visit('/users')
      ->type('Alice', 'name')
      ->press('submit')
      ->see('Alice')
      ->see('0.00');

  }
}
