<?php

namespace App\Http\Controllers;

use App\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategorieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add()
    {
        return view('categorie.add');
    }
    public function getAll()

    {
         $liste_categorie = Categorie::paginate(3);//paginate c'est pour determiner le nombre de client a afficher
         // $liste_categorie = Categorie::all();
        return view('categorie.list', ['liste_categorie' => $liste_categorie]);
    }
    public function edit($id)
    {
        $categorie = Categorie::find($id);
        return view('categorie.edit', ['categorie' => $categorie]);
    }
    public function update(Request $request)
    {
        $categorie =  Categorie::find($request->id);
        $categorie->libelle = $request->nomcategorie;
        $leproduit = $categorie->save();
        return Redirect('/categorie/getall');
    }
    public function delete($id)
    {
        $categorie = Categorie::find($id); //On demande au model Client de prendre les client avec les id  
        if ($categorie != null) //s'il existe des clients on fait le delete.
        {
            $categorie->delete();
        }

        return $this->getAll();
    }
    public function ajouter(Request $request)
    {
        // echo $request->nomclient;
        $categorie = new Categorie();
        $categorie->libelle = $request->nomcategorie;

        $lecategorie = $categorie->save();

        return Redirect::back()->with('success', 'ajout reussit');
    }
}
