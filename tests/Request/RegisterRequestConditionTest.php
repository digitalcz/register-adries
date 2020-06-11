<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Request;

use DateTimeImmutable;
use Generator;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @covers \DigitalCz\RegisterAdries\Request\RegisterRequestCondition
 */
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
        $this->expectExceptionMessage('Invalid operator, allowed operators are [=,>,<,>=,<=,LIKE]');
        new RegisterRequestCondition('foo', 'bar', '<>');
    }

    public function testNormalizeDateTime(): void
    {
        $date = new DateTimeImmutable();
        $condition = new RegisterRequestCondition('foo', $date);
        self::assertEquals($date->format('Y-m-d H:i:s'), $condition->getValue());
    }

    public function testNormalizeFail(): void
    {
        $obj = new stdClass();
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Cannot normalize value of type object');
        new RegisterRequestCondition('foo', $obj);
    }

    /**
     * @param mixed $value
     * @dataProvider provideAsSql
     */
    public function testAsSql(string $field, $value, string $operator, string $expected): void
    {
        $condition = new RegisterRequestCondition($field, $value, $operator);
        self::assertEquals($expected, $condition->asSql());
    }

    /**
     * @return Generator<array<string>>
     */
    public function provideAsSql(): Generator
    {
        yield ['foo', 'baz', RegisterRequestCondition::LIKE, '"foo" LIKE \'baz\''];
        yield ['foo', 'baz', RegisterRequestCondition::LT, '"foo" < \'baz\''];
        yield ['foo', 'baz', RegisterRequestCondition::LTE, '"foo" <= \'baz\''];
        yield ['foo', 'baz', RegisterRequestCondition::GT, '"foo" > \'baz\''];
        yield ['foo', 'baz', RegisterRequestCondition::GTE, '"foo" >= \'baz\''];
        yield ['foo', 'baz', RegisterRequestCondition::EQ, '"foo" = \'baz\''];
    }
}
