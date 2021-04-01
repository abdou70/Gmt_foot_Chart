<?php

use App\Profil;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('profil_user')->truncate();

        $admin =   User::create([
               'name'=>'admin',
               'email'=>'abdou',
               'password'=> Hash::make('passer@1991'),
           ]);
         $caissiere =  User::create([
           'name'=>'Abdou',
           'email'=>'Niang',
           'password'=> Hash::make('passer'),
           ]);

      $adminProfil = Profil::where('status', 'admin')->first();    
      $caissiereProfil= Profil::where('status', 'caissiere')->first();    

      $admin->profils()->attach( $adminProfil);
      $caissiere->profils()->attach( $caissiereProfil);
  
    }
}
