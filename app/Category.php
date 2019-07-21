<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $guarded = [];

    public function getRouteKeyname(){
        return 'slug';
    }

    // public function items(){
    //     return $this->hasMany('App\Item');
    // }
}
