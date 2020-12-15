<?php

use App\place_parking;
use Illuminate\Database\Seeder;

class PlaceparkingTableSeeder extends Seeder
{
    public function run()
    {
        self::createPlParking('MatchaBroSug');
        self::createPlParking('CremeBrulBroSug');
        self::createPlParking('MilkTeaBroSug');
        self::createPlParking('Taro');
        self::createPlParking('OreoTaro');
        self::createPlParking('PecheQQ');
        self::createPlParking('MangueQQ');
        self::createPlParking('PassionQQ');
    }

    private static function createPlParking(string $libel){
        $parking = new place_parking;
        $parking->idparking;
        $parking->libelle = $libel;

        assert($parking->save(),"Echec de l'insertion");

    }

}
