<?php

namespace Patricpoba\ArkeselSms;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Patricpoba\ArkeselSms\Skeleton\SkeletonClass
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
