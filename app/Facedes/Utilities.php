<?php

namespace App\Facedes;

use Illuminate\Support\Facades\Facade;

class Utilities extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'App\Services\Utilities';
    }
    
}