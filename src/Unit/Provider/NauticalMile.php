<?php

namespace Bavix\Geo\Unit\Provider;

use Bavix\Geo\Unit\Distance;
use Bavix\Geo\Unit\Distable;

class NauticalMile extends Distable
{

    /**
     * @return string
     */
    public static function property(): string
    {
        return Distance::PROPERTY_NAUTICAL_MILES;
    }

    /**
     * @return string
     */
    public static function name(): string
    {
        return 'nautical mile';
    }

    /**
     * @return float
     */
    public static function oneMile(): float
    {
        return 0.8689762419006481;
    }

}
