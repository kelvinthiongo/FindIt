<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $fillable = [
        'name', 'slug', 'url', 'image', 'phone', 'source_code_link', 'cpanel_username', 'cpanel_password', 'admin_username', 'admin_password'
    ];
}
