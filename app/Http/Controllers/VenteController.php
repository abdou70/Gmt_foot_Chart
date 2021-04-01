<?php

namespace App\Http\Controllers;
use PDF;
use App\Commande;
use App\Produit;
use App\Reglement;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon as CarbonCarbon;
use Illuminate\Support\Facades\DB;

class VenteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function listproduit()
    {
        $products = Produit::all();
        $typeReglement = Reglement::all();
        return view('ventes.accueil', compact('products', 'typeReglement'));
    }
    public function CurrentVente()
    {
        $today = CarbonCarbon::today();
        $commandes= DB::table('commandes')->where('dateC', '=', $today)->where('etat_commande', '=', null)->paginate(10);  
        return view('ventes.liste', compact('commandes'));
    }
    public function addToCart($id)
    {
        $product = Produit::find($id);

        if (!$product) {

            abort(404);
        }

        $cartv = session()->get('cartv');

        // Si le produit vient d'etre ajouter pour la premier fois
        if (!$cartv) {

            $cartv = [
                $id => [
                    "nom" => $product->nom,
                    "quantity" => 1,
                    "prix" => $product->prix,
                    "photo" => $product->photo,

                ]
            ];

            session()->put('cartv', $cartv);

            return Redirect::back()->with('success', 'Produit ajouté au panier !');
        }

        // Si le produit exist on incremente la quantité 
        if (isset($cartv[$id])) {

            $cartv[$id]['quantity']++;

            session()->put('cartv', $cartv);

            return  Redirect::back()->with('success', 'Produit ajouté au panier !');
        }

        //Si le produit n'exist pas dans le cartv on ajoute avec quantité = 1
        $cartv[$id] = [
            "nom" => $product->nom,
            "quantity" => 1,
            "prix" => $product->prix,
            "photo" => $product->photo,


        ];

        session()->put('cartv', $cartv);

        return  Redirect::back()->with('success', 'Produit ajouté au panier !');
    }


    public function update(Request $request)
    {
        if ($request->id and $request->quantity) {
            $cartv = session()->get('cartv');

            $cartv[$request->id]["quantity"] = $request->quantity;

            session()->put('cartv', $cartv);

            session()->flash('success', 'modification quantité réussit');
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {

            $cartv = session()->get('cartv');

            if (isset($cartv[$request->id])) {

                unset($cartv[$request->id]);

                session()->put('cartv', $cartv);
            }

            session()->flash('warning', 'produit retiré du panier');
        }
    }
      
    public function genererpdf(){
        $infos = session()->get('infos');
        $com = session()->get('com');
        $pdf = PDF::loadView('pdf.ticketVente',compact('com','infos'));
        return $pdf->download(\Str::slug('reçu'.$com->id).".pdf");
       
    }

    public function saveVente(Request $request)
    {
        // dd($request);
        $cartv = session()->get('cartv');
        session()->put('infos', $cartv);
        session()->put('cartv', null);
        $com = new Commande();
        $com->dateC =  CarbonCarbon::today();
        $com->montant = $request->totaux;
        $com->vente  = 1;
        $com->reglement_id  = $request->id_reglement;
        $com->client_id  = null;
        $com->etat_commande  = null;
        $com->save();
        $com->produits()->sync($request->produits);

        session()->get('com');
        session()->put('com', $com);

        return Redirect::back()->with('vente', 'vente engeristrer avec success'); 

       
      
    }

}
