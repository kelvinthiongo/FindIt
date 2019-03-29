<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    public $primaryKey = 'id';
    protected $fillable = [
        'measure', 'duration', 'description', 'user_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
