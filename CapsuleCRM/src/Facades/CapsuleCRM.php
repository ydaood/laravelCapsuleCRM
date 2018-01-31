<?php

namespace CapsuleCRM\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see CapsuleCRM\Facades\CapsuleCRM
 */
class CapsuleCRM extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'CapsuleCRM';
    }
}
