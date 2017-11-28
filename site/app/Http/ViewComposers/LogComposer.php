<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class LogComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        // $view->with('menuTeams', $this->teamList)->with('menuLeagues', $this->leagueList);
        DB::listen(function ($query) {
            Log::info($query->sql);
         });
    }
}