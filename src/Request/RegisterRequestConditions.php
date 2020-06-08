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
    public function asArray(): array
    {
        $array = [];

        foreach ($this->conditions as $condition) {
            $array[$condition->getField()] = $condition->getValue();
        }

        return $array;
    }

    public function asSql(): string
    {
        $conditionsSqls = array_map(
            static function (RegisterRequestCondition $condition) {
                return $condition->asSql();
            },
            $this->conditions
        );

        return implode(' AND ', $conditionsSqls);
    }

    public function add(RegisterRequestCondition $condition): void
    {
        $this->conditions[] = $condition;
    }

    public function count(): int
    {
        return count($this->conditions);
    }

    public function allEq(): bool
    {
        foreach ($this->conditions as $condition) {
            if (!$condition->isEq()) {
                return false;
            }
        }

        return true;
    }
}
