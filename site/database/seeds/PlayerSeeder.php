<?php

use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $con1 = new App\Player;
        $con1->team_id = '1';
        $con1->name = "Kyrie Irving";
        $con1->description = "Kyrie Andrew Irving is an American professional basketball player for the Boston Celtics of the National Basketball Association.";
        $con1->save();

        $con2 = new App\Player;
        $con2->team_id = '1';
        $con2->name = "Gordon Hayward";
        $con2->description = "Gordon Daniel Hayward is an American professional basketball player for the Boston Celtics of the National Basketball Association.";
        $con2->save();

        $con3 = new App\Player;
        $con3->team_id = '1';
        $con3->name = "Jayson Tatum";
        $con3->description = "Jayson Christopher Tatum is an American professional basketball player for the Boston Celtics of the National Basketball Association.";
        $con3->save();
        
        $con4 = new App\Player;
        $con4->team_id = '2';
        $con4->name = "DeMar DeRozan";
        $con4->description = "DeMar Darnell DeRozan is an American professional basketball player for the Toronto Raptors of the National Basketball Association. He played college basketball for USC and was selected ninth overall by the Raptors in the 2009 NBA draft.";
        $con4->save();
    }
}
