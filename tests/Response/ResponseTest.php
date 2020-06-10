<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Response;

use PHPUnit\Framework\TestCase;

/**
 * @covers \DigitalCz\RegisterAdries\Response\Response
 */
class ResponseTest extends TestCase
{
    public function testMultipleRecords(): void
    {
        $response = new Response(
            [
                new Region([]),
                new Region([]),
                new Region([])
            ],
            77
        );

        self::assertEquals(77, $response->getTotal());
        self::assertCount(3, $response->getRecords());
        self::assertNull($response->getSingleRecord());
    }

    public function testGetSingleRecord(): void
    {
        $region = new Region([]);
        $response = new Response([$region], 1);
        self::assertSame($region, $response->getSingleRecord());
    }
}
