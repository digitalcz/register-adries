<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Response;

use PHPUnit\Framework\TestCase;

class CountyTest extends TestCase
{
    public function testConstruct(): void
    {
        $record = [
            'countyCode' => 'foo',
            'countyName' => 'bar',
            'regionIdentifier' => '123'
        ];

        $county = new County($record);

        self::assertSame('foo', $county->getCountyCode());
        self::assertSame('bar', $county->getCountyName());
        self::assertSame(123, $county->getRegionIdentifier());
    }
}
