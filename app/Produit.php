<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = [
        'nom',
        'reference',
        'quantite',
        'photo',
        'prix',
        'categorie_id'
    ];
    public function categorie()
    {
        return $this->belongsTo('App\Categorie');
    }

    public function commandes()
    {
        return $this->belongsToMany('App\Commande');
    }
}
