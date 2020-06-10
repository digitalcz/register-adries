<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Response;

use PHPUnit\Framework\TestCase;

class RegionTest extends TestCase
{
    public function testConstruct(): void
    {
        $record = [
            'regionCode' => 'foo',
            'regionName' => 'bar',
        ];

        $region = new Region($record);

        self::assertSame('foo', $region->getRegionCode());
        self::assertSame('bar', $region->getRegionName());
    }
}
