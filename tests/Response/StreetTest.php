<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Response;

use PHPUnit\Framework\TestCase;

/**
 * @covers \DigitalCz\RegisterAdries\Response\Street
 */
class StreetTest extends TestCase
{
    public function testConstruct(): void
    {
        $record = [
            'streetName' => 'foo',
            'municipalityIdentifiers' => '11,22,33',
            'districtIdentifiers' => '123',
        ];

        $street = new Street($record);

        self::assertSame('foo', $street->getStreetName());
        self::assertSame([11,22,33], $street->getMunicipalityIdentifiers());
        self::assertSame([123], $street->getDistrictIdentifiers());
    }
}
