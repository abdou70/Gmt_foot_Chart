<?php

use App\Profil;
use Illuminate\Database\Seeder;

class ProfilsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profil::truncate();

        Profil::create([
           'status'=>'admin'
       ]);
       Profil::create([
           'status'=>'caissiere'
    ]);
    }
}
