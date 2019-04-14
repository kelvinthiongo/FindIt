<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $guarded = [];

    public function items(){
        return $this->belongsTo('App\Item');
    }
}
