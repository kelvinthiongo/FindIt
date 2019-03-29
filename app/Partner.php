<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    //table name
    protected $table = 'partners'; //just for reference may not be necessary

    public $primaryKey = 'id';
    
    public $timestamps = true; //just for reference already set to true 
}


