<?php

namespace Cybercraftit\Aster;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Cybercraftit\Aster\Skeleton\SkeletonClass
 */
class AsterFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'aster';
    }
}
