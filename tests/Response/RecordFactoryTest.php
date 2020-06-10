<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Response;

use DigitalCz\RegisterAdries\RegisterResource;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigitalCz\RegisterAdries\Response\RecordFactory
 */
class RecordFactoryTest extends TestCase
{
    public function testCreateFromResults(): void
    {
        $factory = new RecordFactory();
        $records = $factory->createFromResults(
            RegisterResource::createRegion(),
            [
                ['objectId' => 69],
                ['objectId' => 420]
            ]
        );

        self::assertCount(2, $records);
        self::assertEquals(69, $records[0]->getObjectId());
        self::assertEquals(420, $records[1]->getObjectId());
    }
}
