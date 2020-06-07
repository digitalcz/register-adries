<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Query;

use ArrayObject;

/**
 * @extends ArrayObject<int, RegisterQueryCondition>
 */
class RegisterQueryConditions extends ArrayObject
{
    /**
     * @return array<string, string>
     */
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
