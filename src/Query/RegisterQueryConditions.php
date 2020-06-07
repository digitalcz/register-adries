<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Query;

class RegisterQueryConditions extends \ArrayObject
{

    public function toArray(): array
    {
        $array = [];

        /** @var RegisterQueryCondition $condition */
        foreach ($this as $condition) {
            $array[$condition->getField()] = $condition->getValue();
        }

        return $array;
    }
}
