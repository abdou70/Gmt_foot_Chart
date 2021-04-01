<?php

namespace App\Http\Controllers;

use App\Client;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add()
    {
        $client = Client::paginate(7);
        return view('Client.add')->with("clients", $client);
    }

    public function export()
    {

        $clients = Client::all();
        $pdf = PDF::loadView('pdf.client', compact('clients'));

        return $pdf->download('clients.pdf');
    }

    public function persist(Request  $request)
    {

        $client = DB::table("clients")->insert(array(
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'tel' => $request->telephone,
            'fidele' => 0,
        ));
        // $client->save();
        return redirect('/client/add')->with('success', 'Client enregistrer');
    }
    public function update(Request  $request)
    {

        $clients = Client::find($request->id);

        $clients->nom = $request->nom;
        $clients->adresse = $request->adresse;
        $clients->tel = $request->telephone;
        $Client = $clients->save();
        return redirect('/client/add')->with('success', 'client modifier');
    }

    public function edit($id)
    {
        $clients = Client::find($id);

        return view('Client.edit', compact('clients', $clients));
    }




    public function delete($id)
    {
        $clients = Client::find($id);

        $clients->delete();
        return redirect('/client/add')->with('success', 'client supprimer');
    }




    public function index()
    {

        if (request('search') != null) {
            $clients['data'] = DB::table('clients')->where('nom', "like", '%' . request('search') . '%')->get();
            if ($clients['data']) {
                $clients['success'] = "ok";
            } else
                $clients['error'] = "erreur";


            return response()->json($clients);
        }
    }
}
