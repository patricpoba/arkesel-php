<?php

namespace PatricPoba\Arkesel;

use Illuminate\Support\Facades\Facade;

/**
 * @see \PatricPoba\Arkesel\Skeleton\SkeletonClass
 */
class ArkeselSmsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'arkesel-sms';
    }
}
