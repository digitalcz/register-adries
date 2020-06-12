<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Response;

use PHPUnit\Framework\TestCase;

/**
 * @covers \DigitalCz\RegisterAdries\Response\District
 */
class DistrictTest extends TestCase
{
    public function testConstruct(): void
    {
        $record = [
            'uniqueNumbering'        => true,
            'districtCode'           => '234',
            'districtName'           => 'Foo',
            'municipalityIdentifier' => '123',
        ];

        $district = new District($record);

        self::assertTrue($district->getUniqueNumbering());
        self::assertSame(234, $district->getDistrictCode());
        self::assertSame('Foo', $district->getDistrictName());
        self::assertSame(123, $district->getMunicipalityIdentifier());
    }
}
