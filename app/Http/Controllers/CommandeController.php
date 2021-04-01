<?php

namespace App\Http\Controllers;
use PDF;
use App\Client;
use App\Commande;
use App\Produit;
use App\Reglement;
use Carbon\Carbon as CarbonCarbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CommandeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listproduit()
    {
        $products = Produit::all();
        $typeReglement = Reglement::all();
        return view('commande.accueil', compact('products', 'typeReglement'));
    }

    public function CommandeNonLivres()
    {
        $today = CarbonCarbon::today();
        $commandes= DB::table('commandes')->where('dateC', '=', $today)->where('etat_commande', '=', 0)->paginate(10);  
        return view('commande.nonlivres', compact('commandes'));
    }
    
    public function CurrentCommande()
    {
        $today = CarbonCarbon::today();
        $commandes= DB::table('commandes')->where('dateC', '=', $today)->where('etat_commande', '!=', null)->paginate(10);  
        return view('commande.liste', compact('commandes'));
    }

    public function ValiderLivraison($id)
    {
        $nonLivres = Commande::find($id);
        $nonLivres->vente = 1;
        
        $nonLivres->etat_commande = 1;
        $nonLivres->save();
       return $this->CurrentCommande();
    }

    public function genererpdf(){
        $info = session()->get('info');
        $commande = session()->get('commande');
        $client = session()->get('client');
        $pdf = PDF::loadView('pdf.ticketCommande',compact('commande','info','client'));
        return $pdf->download(\Str::slug('reçu'.$commande->id).".pdf");
       
    }

    public function saveCommande(Request $request)
    {
       // dd($request);
        $cart = session()->get('cart');
        session()->put('info', $cart);
        session()->put('cart', null);
        $cartv = session()->get('cart');
       // dd($request);
        $com = new Commande();
        if($request->idClient != null){
            $client = Client::find($request->idClient);
            $com->client_id  = $client->id;
        }else{
            $client = new Client();
            $client->nom = $request->nom;
            $client->adresse = $request->adresse;
            $client->tel = $request->telephone;
            $client->fidele = 0;
            $client->save();
            $com->client_id  = $client->id;
        }
        $com->dateC =  CarbonCarbon::today();
        $com->montant = $request->totaux;
        $com->vente  = 0;
        $com->reglement_id  = $request->id_reglement;
        $com->etat_commande  = 0;
        $com->save();
        $com->produits()->sync($request->produits);
        session()->get('commande');
        session()->get('client');
        session()->put('commande', $com);
        session()->put('client', $client);
        return Redirect::back()->with('comm', 'commande engeristrer avec success');
    }

    public function cart()
    {
        return view('cart');
    }


    public function addToCart($id)
    {
        $product = Produit::find($id);

        if (!$product) {

            abort(404);
        }

        $cart = session()->get('cart');

        // Si le produit vient d'etre ajouter pour la premier fois
        if (!$cart) {

            $cart = [
                $id => [
                    "nom" => $product->nom,
                    "quantity" => 1,
                    "prix" => $product->prix,
                    "photo" => $product->photo,

                ]
            ];

            session()->put('cart', $cart);

            return Redirect::back()->with('success', 'Produit ajouté au panier !');
        }

        // Si le produit exist on incremente la quantité 
        if (isset($cart[$id])) {

            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            return  Redirect::back()->with('success', 'Produit ajouté au panier !');
        }

        //Si le produit n'exist pas dans le cart on ajoute avec quantité = 1
        $cart[$id] = [
            "nom" => $product->nom,
            "quantity" => 1,
            "prix" => $product->prix,
            "photo" => $product->photo,


        ];

        session()->put('cart', $cart);

        return  Redirect::back()->with('success', 'Produit ajouté au panier !');
    }


    public function update(Request $request)
    {
        if ($request->id and $request->quantity) {
            $cart = session()->get('cart');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);

            session()->flash('success', 'modification quantité réussit');
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {

            $cart = session()->get('cart');

            if (isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            session()->flash('warning', 'produit retiré du panier');
        }
    }

    public function stat()
    {

        $today = CarbonCarbon::today();
        $commandes= DB::table('commandes')->where('dateC', '=', $today)->where('etat_commande', '=', 1)->get();

        $ventes= DB::table('commandes')->where('dateC', '=', $today)->where('vente', '=', 1)->get();

        $non_regle= DB::table('commandes')->where('dateC', '=', $today)->where('etat_commande', '=', 0)->get();

        $compte=0;
        foreach ($commandes as $com){
            $compte=$compte +1;
        }

        $vente=0;
        $caisse=0;
        foreach($ventes as $vent){
            $caisse = $caisse + $vent->montant;
            $vente=$vente+1;
        }
        $nonre=0;
        foreach($non_regle as $r){
            $nonre=$nonre+1;
        }

        return view('statistique.liste',['compte' => $compte,'caisse'=>$caisse],['vente'=>$vente,'nonre'=>$nonre]);

    }

    public function search()
    {
        if (request('search') != null) {
            $clients['data'] = DB::table('clients')->where('tel',request('search'))->first();
            if ($clients['data']) {
                $clients['success'] = "ok";
            } else
                $clients['error'] = "erreur";

            return response()->json($clients);
        }
       
    }

}
