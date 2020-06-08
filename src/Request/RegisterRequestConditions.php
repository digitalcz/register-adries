<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Request;

class RegisterRequestConditions
{
    /**
     * @var RegisterRequestCondition[]
     */
    private $conditions = [];

    /**
     * @return array<string, string>
     */
    public function toArray(): array
    {
        $array = [];

        foreach ($this->conditions as $condition) {
            $array[$condition->getField()] = $condition->getValue();
        }

        return $array;
    }

    public function add(RegisterRequestCondition $condition): void
    {
        $this->conditions[] = $condition;
    }

    public function count(): int
    {
        return count($this->conditions);
    }
}
