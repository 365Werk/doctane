<?php

namespace Werk365\Doctane\Facades;

use Illuminate\Support\Facades\Facade;

class Doctane extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'doctane';
    }
}
