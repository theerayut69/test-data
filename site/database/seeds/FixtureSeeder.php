<?php

use Illuminate\Database\Seeder;

class FixtureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $con1 = new App\Fixture;
        $con1->league_id = "1";
        $con1->home_team = "1";
        $con1->away_team = "2";
        $con1->play_date = "2017-11-27 15:41:00";
        $con1->save();

        $con2 = new App\Fixture;
        $con2->league_id = "1";
        $con2->home_team = "3";
        $con2->away_team = "4";
        $con2->play_date = "2017-11-27 15:41:00";
        $con2->save();

        $con3 = new App\Fixture;
        $con3->league_id = "2";
        $con3->home_team = "6";
        $con3->away_team = "7";
        $con3->play_date = "2017-11-27 15:41:00";
        $con3->save();
        
        $con4 = new App\Fixture;
        $con4->league_id = "2";
        $con4->home_team = "8";
        $con4->away_team = "9";
        $con4->play_date = "2017-11-27 15:41:00";
        $con4->save();
                
        $con5 = new App\Fixture;
        $con5->league_id = "3";
        $con5->home_team = "11";
        $con5->away_team = "12";
        $con5->play_date = "2017-11-28 15:41:00";
        $con5->save();
                
        $con6 = new App\Fixture;
        $con6->league_id = "3";
        $con6->home_team = "13";
        $con6->away_team = "14";
        $con6->play_date = "2017-11-28 15:41:00";
        $con6->save();
                
        $con7 = new App\Fixture;
        $con7->league_id = "1";
        $con7->home_team = "1";
        $con7->away_team = "4";
        $con7->play_date = "2017-11-28 15:41:00";
        $con7->save();
                
        $con8 = new App\Fixture;
        $con8->league_id = "1";
        $con8->home_team = "1";
        $con8->away_team = "3";
        $con8->play_date = "2017-11-27 15:41:00";
        $con8->save();
                
        $con9 = new App\Fixture;
        $con9->league_id = "2";
        $con9->home_team = "6";
        $con9->away_team = "7";
        $con9->play_date = "2017-11-28 15:41:00";
        $con9->save();
    }
}
