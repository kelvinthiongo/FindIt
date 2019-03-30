<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [];

    public function getRouteKeyname(){
        return 'slug';
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }
}
