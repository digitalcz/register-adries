<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Response;

use DateTime;
use PHPUnit\Framework\TestCase;

class EntranceTest extends TestCase
{
    public function testConstruct(): void
    {
        $record = [
            'buildingNumber' => 'A112',
            'buildingIndex' => 'foo',
            'postalCode' => '44353',
            'axisB' => '53.343894983',
            'axisL' => '55.334343224',
            'propertyRegistrationNumberIdentifier' => 69,
            'streetNameIdentifier' => 420,
            'verifiedAt' => '2016-12-12'
        ];

        $entrance = new Entrance($record);

        self::assertSame('A112', $entrance->getBuildingNumber());
        self::assertSame('foo', $entrance->getBuildingIndex());
        self::assertSame('44353', $entrance->getPostalCode());
        self::assertSame('53.343894983', $entrance->getAxisB());
        self::assertSame('55.334343224', $entrance->getAxisL());
        self::assertSame(69, $entrance->getPropertyRegistrationNumberIdentifier());
        self::assertSame(420, $entrance->getStreetNameIdentifier());
        self::assertEquals(new DateTime('2016-12-12'), $entrance->getVerifiedAt());
    }
}
