<?php
namespace Irazasyed\Wit\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

class Wit extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'wit';
    }
}