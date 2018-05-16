<?php

namespace Bavix\Geo\Unit;

use Bavix\Geo\Value\Valable;

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
        if ($name === Item::PROPERTY_MILES && $prop === static::property()) {
            return $object->$name * static::oneMile();
        }

        if ($prop === Item::PROPERTY_MILES && $name === static::property()) {
            $object->$prop = $object->$name / static::oneMile();
        }

        return null;
    }

}
