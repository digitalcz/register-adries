<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Response;

use PHPUnit\Framework\TestCase;

/**
 * @covers \DigitalCz\RegisterAdries\Response\Municipality
 */
class MunicipalityTest extends TestCase
{
    public function testConstruct(): void
    {
        $record = [
            'municipalityCode' => 'foo',
            'municipalityName' => 'bar',
            'countyIdentifier' => '123',
            'status'           => 'baz',
            'cityIdentifier'   => '777',
        ];

        $municipality = new Municipality($record);

        self::assertSame('foo', $municipality->getMunicipalityCode());
        self::assertSame('bar', $municipality->getMunicipalityName());
        self::assertSame(123, $municipality->getCountyIdentifier());
        self::assertSame('baz', $municipality->getStatus());
        self::assertSame(777, $municipality->getCityIdentifier());
    }
}
