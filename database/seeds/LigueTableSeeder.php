<?php

use App\ligue;
use Illuminate\Database\Seeder;


class LigueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        self::createLigue('Ligue de Karaté');
        self::createLigue('Ligue de Judo');
        self::createLigue('Ligue de Yoga');
        self::createLigue('Ligue de Athletisme');
        self::createLigue('Ligue de Rugby');
        self::createLigue('Ligue de Babyfoot');
        self::createLigue('Ligue de Natation');
    }

    private static function createLigue(string $nom){
        $ligue = new ligue;
        $ligue->idligue;
        $ligue->nomligue = $nom;

        assert($ligue->save(),"Echec de l'insertion de : '$nom'");
    }
}
