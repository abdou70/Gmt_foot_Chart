<?php

namespace App\Http\Controllers;


use App\Reglement;
use Illuminate\Http\Request;

class ReglementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add()
    {
        return view('reglement.add');
    }
    public function getAll()

    {
        $liste_reglement = Reglement::all(); //paginate c'est pour determiner le nombre de produit a afficher

        return view('reglement.liste', ['liste_reglement' => $liste_reglement]);
    }

    public function ajouter(Request $request)
    {

        $reglement = new Reglement();
        $reglement->type_reglement = $request->nomreglement;
        $lereglement = $reglement->save();

        return redirect()->back()->with('success', 'mode payement ajouter');
    }
}
