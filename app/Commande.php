<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = [
        'dateC',
        'montant',
        'vente',
        'reglement_id',
        'client_id',
        'etat_commande_id'
       
    ];
    public function reglement()
    {
        return $this->belongsTo('App\Reglement');
    }
    public function client()
    {
        return $this->belongsTo('App\Client');
    }
    public function produits()
    {
        return $this->belongsToMany('App\Produit');
    }
}
