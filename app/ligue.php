<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ligue extends Model
{
    public $timestamps = false;

    public function utilisateurs(){
        return $this->hasMany("App/utilisateur");
    }
}
