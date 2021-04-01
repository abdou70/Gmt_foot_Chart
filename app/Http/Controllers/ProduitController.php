<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProduitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function codeAleatoire($car)
    {
        $string = "";
        $chaine = "2643789ABDCEFGHJKMNPRTUVW";
        srand((double)microtime()*1000000);
        for($i=0; $i<$car; $i++)
        {
            $string .= $chaine[rand()%strlen($chaine)];
        }
        return $string;
    }

    public function add()
    {
        $categories = Categorie::all();
        return Redirect::back()->with('success', 'ajout reussit');
    }
    public function getAll()

    {
        $liste_produit = Produit::paginate(5); //paginate c'est pour determiner le nombre de produit a afficher
        //$liste_client = Client::all();
        $categories = Categorie::all();
        return view('produit.liste', ['liste_produit' => $liste_produit, 'les_categorie' => $categories]);
    }
    public function edit($id)
    {
        $produit = Produit::find($id);
        $categories = Categorie::all();
        return view('produit.edit', ['produit' => $produit, 'les_categorie' => $categories]);
    }
    public function update(Request $request)
    {
        $produit =  Produit::find($request->id);
        $produit->nom = $request->nomproduit;
        $produit->reference = $this->codeAleatoire(2)."".substr($produit->nom, 3) ;
//      $produit->quantite = $request->quantiteproduit;
        $produit->prix = $request->prixproduit;
        $produit->categorie_id = $request->id_categorie;
        $leproduit = $produit->save();
        return Redirect('/produit/getall');
    }
    public function delete($id)
    {
        $produit = Produit::find($id); //On demande au model Client de prendre les client avec les id  
        if ($produit != null) //s'il existe des clients on fait le delete.
        {
            $produit->delete();
        }

        return Redirect('/produit/getall');
    }
    public function ajouter(Request $request)
    {


        // echo $request->nomclient;
        $produit = new Produit();
        $produit->nom = $request->nomproduit;
        $produit->reference = $this->codeAleatoire(2)."".substr($produit->nom, 0,3);;
        $produit->prix = $request->prixproduit;
        $produit->photo = $request->photoproduit;
        $produit->categorie_id = $request->id_categorie;

        if ($files = $request->file('photo')) {

            $destinationPath = 'images/produits/'; // upload path
            $image = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $image);
            $path = '/images/produits/' . $image;
            $url = url($path);
            $produit->photo = $url;
        }
        $produit->save();

        return redirect()->route('addproduit');
    }
}
