<?php

use Illuminate\Database\Seeder;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
      $users = [
        [
          'name' => 'Alice',
          'balance' => 100
        ],
        [
          'name' => 'Bob',
          'balance' => 200
        ]
      ];

      $db = DB::table('users'); 
      $db->truncate();
      foreach($users as $user){
        $db->insert($user);
      }
    }
}
