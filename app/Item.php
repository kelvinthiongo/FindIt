<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Nicolaslopezj\Searchable\SearchableTrait; //From github: https://github.com/nicolaslopezj/searchable

class Item extends Model
{

    use SearchableTrait;

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
            'items.number' => 10,
            'items.f_name' => 7,
            'items.s_name' => 7,
            'items.l_name' => 7,
            'items.lf_date' => 1,
            'items.place_found' => 1,
        ],
        // 'joins' => [
        //     'categories' => ['items.category_id','categories.id'],
        // ],
    ];

    public function getRouteKeyname(){
        return 'slug';
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }
}
