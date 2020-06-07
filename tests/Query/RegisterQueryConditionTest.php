<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Query;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class RegisterQueryConditionTest extends TestCase
{

    public function testCreate(): void
    {
        $condition = new RegisterQueryCondition('foo', 'bar', RegisterQueryCondition::EQ);
        self::assertEquals('foo', $condition->getField());
        self::assertEquals('bar', $condition->getValue());
        self::assertTrue($condition->isEq());
    }

    public function testCreateGt()
    {
        $condition = new RegisterQueryCondition('moo', 'baz', RegisterQueryCondition::GT);
        self::assertEquals('moo', $condition->getField());
        self::assertEquals('baz', $condition->getValue());
        self::assertFalse($condition->isEq());
    }

    public function testInvalidOperator(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new RegisterQueryCondition('foo', 'bar', '<>');
    }
}
