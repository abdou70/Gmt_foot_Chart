<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commande;
use App\Client;

use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function statecommande(){
        $commande = Commande::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
        $chart = Charts::database($commande, 'bar','highcharts')
                  ->title("Commande Details")
                  ->elementLabel("Total Commande")
                  #->dimension(1000,500)
                  ->responsive(false)
                  ->groupByMonth(date('Y'),true);

        return view('charts.state',compact('chart'));
    } 

    public function stateclient(){
        $client = Client::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
        $chart1 = Charts::database($client,'pie','highcharts')
                   ->title("Client Details")
                   ->elementLabel("Tous Les Clients")
                   ->responsive(false)
                   ->groupByMonth(date('Y'),true);
        return view('charts.chart1',compact('chart1'));
    }
}
