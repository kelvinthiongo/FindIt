<?php

namespace bnjns\LaravelNotifications\Facades;

use bnjns\LaravelNotifications\NotificationHandler;
use Illuminate\Support\Facades\Facade;

class Notify extends Facade
{
    protected static function getFacadeAccessor()
    {
        return NotificationHandler::class;
    }
}
