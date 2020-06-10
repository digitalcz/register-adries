<?php

namespace DigitalCz\RegisterAdries\Request;

use PHPUnit\Framework\TestCase;

class RegisterRequestConditionsTest extends TestCase
{
    public function testAsArray(): void
    {
        $conditions = new RegisterRequestConditions();
        $conditions->add(new RegisterRequestCondition('foo', 'bar'));
        $conditions->add(new RegisterRequestCondition('baz', 'moo'));

        self::assertEquals(
            [
                'foo' => 'bar',
                'baz' => 'moo'
            ],
            $conditions->asArray()
        );
        self::assertEquals(2, $conditions->count());
    }

    public function testAllEq(): void
    {
        $conditions = new RegisterRequestConditions();
        $conditions->add(new RegisterRequestCondition('foo', 'bar'));
        $conditions->add(new RegisterRequestCondition('baz', 'moo'));

        self::assertTrue($conditions->allEq());

        $conditions = new RegisterRequestConditions();
        $conditions->add(new RegisterRequestCondition('foo', 'bar'));
        $conditions->add(new RegisterRequestCondition('baz', 'moo', RegisterRequestCondition::GT));

        self::assertFalse($conditions->allEq());
    }

    public function testAsSql(): void
    {
        $conditions = new RegisterRequestConditions();
        $conditions->add(new RegisterRequestCondition('foo', 'bar'));
        $conditions->add(new RegisterRequestCondition('baz', 'moo', RegisterRequestCondition::GT));

        self::assertEquals('"foo" = \'bar\' AND "baz" > \'moo\'', $conditions->asSql());
    }
}
