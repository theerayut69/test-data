<?php

use Illuminate\Database\Seeder;

class LeagueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $con1 = new App\League;
        $con1->name = "NBA";
        $con1->description = "NBA";
        $con1->save();

        $con2 = new App\League;
        $con2->name = "NBA G League";
        $con2->description = "NBA G League";
        $con2->save();

        $con3 = new App\League;
        $con3->name = "NCAA";
        $con3->description = "NCAA";
        $con3->save();
        
    }
}