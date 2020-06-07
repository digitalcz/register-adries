<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Query;

use InvalidArgumentException;

class RegisterQueryCondition
{
    public const EQ = '=';
    public const GT = '>';
    public const LT = '<';
    public const GTE = '>=';
    public const LTE = '<=';

    /**
     * @var string[]
     */
    private static $availabileOperators = [
        self::EQ,
        self::GT,
        self::LT,
        self::GTE,
        self::LTE
    ];

    /**
     * @var string
     */
    private $field;

    /**
     * @var string
     */
    private $operator;

    /**
     * @var string
     */
    private $value;

    public function __construct(string $field, string $value, string $operator = self::EQ)
    {
        $this->guardOperator($operator);

        $this->field = $field;
        $this->operator = $operator;
        $this->value = $value;
    }

    private function guardOperator(string $operator): void
    {
        if (!in_array($operator, self::$availabileOperators, true)) {
            throw new InvalidArgumentException('Unknown operator ' . $operator);
        }
    }

    public function getField(): string
    {
        return $this->field;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function isEq(): bool
    {
        return $this->operator === self::EQ;
    }
}
