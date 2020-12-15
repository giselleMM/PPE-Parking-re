<?php

namespace App;

use App\Enums\AuthEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class utilisateur extends Model
{
    public $timestamps = false;

    protected $fillable = ['mdp'];

    public function reservations(){
        return $this->hasMany('App\reservation');
    }

    public function ligue(){
        return $this->belongsTo('App\ligue');
    }


}
