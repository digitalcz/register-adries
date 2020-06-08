<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Request;

use DateTimeInterface;
use InvalidArgumentException;
use UnexpectedValueException;

class RegisterRequestCondition
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

    /**
     * @param mixed $value
     */
    public function __construct(string $field, $value, string $operator = self::EQ)
    {
        $this->guardOperator($operator);
        $value = $this->normalizeValue($value);

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

    public function asSql(): string
    {
        return sprintf(
            '"%s" %s \'%s\'',
            $this->field,
            $this->operator,
            $this->value
        );
    }

    /**
     * @param mixed $value
     */
    private function normalizeValue($value): string
    {
        if ($value instanceof DateTimeInterface) {
            return $value->format('Y-m-d H:i:s');
        }

        if (is_scalar($value)) {
            return (string)$value;
        }

        throw new UnexpectedValueException(sprintf('Unexpected type for value %s', gettype($value)));
    }
}
