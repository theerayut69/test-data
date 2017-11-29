<?php

use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $con1 = new App\Team;
        $con1->league_id = '1';
        $con1->name = "Boston Celtics";
        $con1->logo = "1.png";
        $con1->description = "The Boston Celtics are an American professional basketball team based in Boston, Massachusetts. The Celtics compete in the National Basketball Association as a member of the league's Eastern Conference Atlantic Division.";
        $con1->save();
        
        $con2 = new App\Team;
        $con2->league_id = '1';
        $con2->name = "Toronto Raptors";
        $con2->logo = "2.png";
        $con2->description = "The Toronto Raptors are a Canadian professional basketball team based in Toronto, Ontario. The Raptors compete in the National Basketball Association, as a member club of the league's Eastern Conference Atlantic Division.";
        $con2->save();

        $con3 = new App\Team;
        $con3->league_id = '1';
        $con3->name = "New York Knicks";
        $con3->logo = "3.png";
        $con3->description = "The New York Knickerbockers, commonly referred to as the Knicks, are an American professional basketball team based in New York City in the borough of Manhattan.";
        $con3->save();
        
        $con4 = new App\Team;
        $con4->league_id = '1';
        $con4->name = "Philadelphia 76ers";
        $con4->logo = "4.png";
        $con4->description = "The Philadelphia 76ers are an American professional basketball team based in the Philadelphia metropolitan area.";
        $con4->save();
        
        $con5 = new App\Team;
        $con5->league_id = '1';
        $con5->name = "Brooklyn Nets";
        $con5->logo = "5.png";
        $con5->description = "The Brooklyn Nets are an American professional basketball team based in the New York City borough of Brooklyn. The Nets compete in the National Basketball Association as a member club of the Atlantic Division of the Eastern Conference.";
        $con5->save();
        
        $con6 = new App\Team;
        $con6->league_id = '2';
        $con6->name = "Detroit Pistons";
        $con6->logo = "6.png";
        $con6->description = "Detroit Pistons";
        $con6->save();
        
        $con7 = new App\Team;
        $con7->league_id = '2';
        $con7->name = "Cleveland Cavaliers";
        $con7->logo = "7.png";
        $con7->description = "Cleveland Cavaliers";
        $con7->save();
        
        $con8 = new App\Team;
        $con8->league_id = '2';
        $con8->name = "Indiana Pacers";
        $con8->logo = "8.png";
        $con8->description = "Indiana Pacers";
        $con8->save();
        
        $con9 = new App\Team;
        $con9->league_id = '2';
        $con9->name = "Milwaukee Bucks";
        $con9->logo = "9.png";
        $con9->description = "Milwaukee Bucks";
        $con9->save();
        
        $con10 = new App\Team;
        $con10->league_id = '2';
        $con10->name = "Chicago Bulls";
        $con10->logo = "10.png";
        $con10->description = "Chicago Bulls";
        $con10->save();
        
        $con11 = new App\Team;
        $con11->league_id = '3';
        $con11->name = "Portland Trail Blazers";
        $con11->logo = "11.png";
        $con11->description = "Portland Trail Blazers";
        $con11->save();
        
        $con12 = new App\Team;
        $con12->league_id = '3';
        $con12->name = "Denver Nuggets";
        $con12->logo = "12.png";
        $con12->description = "Denver Nuggets";
        $con12->save();
        
        $con13 = new App\Team;
        $con13->league_id = '3';
        $con13->name = "Minnesota Timberwolves";
        $con13->logo = "13.png";
        $con13->description = "Minnesota Timberwolves";
        $con13->save();
        
        $con14 = new App\Team;
        $con14->league_id = '3';
        $con14->name = "Oklahoma City Thunder";
        $con14->logo = "14.png";
        $con14->description = "Oklahoma City Thunder";
        $con14->save();
        
        $con15 = new App\Team;
        $con15->league_id = '3';
        $con15->name = "Utah Jazz";
        $con15->logo = "15.png";
        $con15->description = "Utah Jazz";
        $con15->save();
    }
}
