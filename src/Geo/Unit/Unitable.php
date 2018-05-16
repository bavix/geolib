<?php

namespace Bavix\Geo\Unit;

use Bavix\Geo\Valable;

abstract class Unitable implements UnitInterface
{

    /**
     * @param Valable $object
     * @param string $name
     * @param string $prop
     * @return mixed
     */
    public static function modify(Valable $object, string $name, string $prop)
    {
        if ($name === Unit::PROPERTY_MILES && $prop === static::property()) {
            return $object->$name * static::oneMile();
        }

        if ($prop === Unit::PROPERTY_MILES && $name === static::property()) {
            $object->$prop = $object->$name / static::oneMile();
        }

        return null;
    }

}
