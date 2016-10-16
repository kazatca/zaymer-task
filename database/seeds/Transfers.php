<?php

use Illuminate\Database\Seeder;

class Transfers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
      
      $transfers = [
        [
          'from' => 1,
          'to' => 2,
          'volume' => 10
        ]
      ];

      $db = DB::table('transfers');
      $db->truncate();
      foreach($transfers as $transfer){
        $db->insert($transfer);
      }

    }
}
