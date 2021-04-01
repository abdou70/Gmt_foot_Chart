<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $fillable = [
        'status'
    ];

    public function users()
    {
      return $this->belongsToMany('App\User');
    }
}
