<?php

namespace OmniaDigital\OmniaLibrary\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \OmniaDigital\OmniaLibrary\OmniaLibrary
 */
class OmniaLibrary extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'library';
    }
}
