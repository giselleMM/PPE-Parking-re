<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\reservation;

class place_parking extends Model
{
    public $timestamps = false;

    protected $fillable = ['id', 'libelle'];

    //Relationships one to many : one place of parking has many reservation
    public function reservations()
    {
        return $this->hasMany('App\reservation');
    }
}

