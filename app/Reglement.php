<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reglement extends Model
{
    protected $fillable = [
        'typeReglement',
    
    ]; 
    public function commandes()
    {
        return $this->hasMany('App\Commande');
    }
}
