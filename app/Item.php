<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Nicolaslopezj\Searchable\SearchableTrait; //From github: https://github.com/nicolaslopezj/searchable

class Item extends Model
{

    use SearchableTrait;
    use SoftDeletes;

    protected $guarded = [];

    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'items.number' => 3,
            'items.name' => 2,
            'items.collection_point' => 1,
        ],
        // 'joins' => [
        //     'categories' => ['items.category_id','categories.id'],
        // ],
    ];


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function reports(){
        return $this->hasMany('App\Report');
    }
    public function category(){
        return $this->belongsTo('App\Category');
    }
}
