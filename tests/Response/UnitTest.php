<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Response;

use PHPUnit\Framework\TestCase;

/**
 * @covers \DigitalCz\RegisterAdries\Response\Unit
 */
class UnitTest extends TestCase
{
    public function testConstruct(): void
    {
        $record = [
            'unitNumber' => 'foo',
            'floor' => '4',
            'buildingNumberIdentifier' => '333',
        ];

        $unit = new Unit($record);

        self::assertSame('foo', $unit->getUnitNumber());
        self::assertSame(4, $unit->getFloor());
        self::assertSame(333, $unit->getBuildingNumberIdentifier());
    }
}
