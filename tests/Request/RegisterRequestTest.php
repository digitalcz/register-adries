<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Request;

use DigitalCz\RegisterAdries\RegisterResource;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigitalCz\RegisterAdries\Request\RegisterRequest
 */
class RegisterRequestTest extends TestCase
{
    public function testAsArray(): void
    {
        $request = new RegisterRequest(RegisterResource::createUnit());
        $request->addCondition(new RegisterRequestCondition('foo', 'bar'));
        $request->setConditions([new RegisterRequestCondition('moo', 'baz')]);
        $request->setLimit(10);
        $request->setOffset(5);

        self::assertTrue($request->isSimple());
        self::assertEquals(
            [
                'resource_id' => $request->getResource()->getId(),
                'limit'       => 10,
                'offset'      => 5,
                'filters'     => [
                    'foo' => 'bar',
                    'moo' => 'baz',
                ],
            ],
            $request->asArray()
        );
    }

    public function testAsSql(): void
    {
        $request = new RegisterRequest(RegisterResource::createUnit());
        $request->addCondition(new RegisterRequestCondition('foo', 'bar', RegisterRequestCondition::LIKE));
        $request->setConditions([new RegisterRequestCondition('moo', 'baz')]);
        $request->setOffset(5);

        self::assertFalse($request->isSimple());
        self::assertEquals(
            sprintf(
                'SELECT * FROM "%s" WHERE "foo" LIKE \'bar\' AND "moo" = \'baz\' LIMIT 100 OFFSET 5;',
                $request->getResource()->getId()
            ),
            $request->asSql()
        );
        self::assertEquals(
            "SELECT count(*) FROM \"{$request->getResource()->getId()}\" WHERE \"foo\" LIKE 'bar' AND \"moo\" = 'baz';",
            $request->asSqlCount()
        );
    }
}
