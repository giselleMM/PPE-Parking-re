<?php

use Illuminate\Database\Seeder;
use App\utilisateur;
use App\admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $utilisateur = new utilisateur;
        $utilisateur->id;
        $utilisateur->pseudo = 'admin';
        $utilisateur->mdp = Hash::make('admin');
        $utilisateur->nom = 'Administrateur';
        $utilisateur->prenom = 'Administrateur';
        $utilisateur->email = 'admin@admin.admin';
        $utilisateur->telephone = '0777777777';
        $utilisateur->role = 'admin';

        $utilisateur->save();
    }
}
