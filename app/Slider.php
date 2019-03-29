<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    //
    protected $fillable = [
        'title', 'message', 'link_message', 'link', 'image', 'slug'
    ];
}
