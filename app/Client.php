<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'adresse',
        'tel',
        'email',
        'fidele'

    ]; 

    public function commandes()
    {
        return $this->hasMany('App\Commande');
    }
}
