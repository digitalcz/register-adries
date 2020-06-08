<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Request;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class RegisterRequestConditionTest extends TestCase
{
    public function testCreate(): void
    {
        $condition = new RegisterRequestCondition('foo', 'bar', RegisterRequestCondition::EQ);
        self::assertEquals('foo', $condition->getField());
        self::assertEquals('bar', $condition->getValue());
        self::assertTrue($condition->isEq());
    }

    public function testCreateGt(): void
    {
        $condition = new RegisterRequestCondition('moo', 'baz', RegisterRequestCondition::GT);
        self::assertEquals('moo', $condition->getField());
        self::assertEquals('baz', $condition->getValue());
        self::assertFalse($condition->isEq());
    }

    public function testInvalidOperator(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new RegisterRequestCondition('foo', 'bar', '<>');
    }
}
