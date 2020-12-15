<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\place_parking;

class reservation extends Model
{
    public $timestamps = false;
    

    protected $primaryKey = 'id';
    
    
    public function place_parking()
    {
        return $this->belongsTo('App\place_parking');
    }

    public function utilisateur()
    {
        return $this->belongsTo('App\utilisateur');
    }
}
