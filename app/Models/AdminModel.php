<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin';

    /*
    * The primary key associated with the table.
    *
    * @var string
     */
    protected $primaryKey = 'idAdmin';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    
}
