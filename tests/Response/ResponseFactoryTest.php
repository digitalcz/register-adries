<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Response;

use DigitalCz\RegisterAdries\RegisterResource;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigitalCz\RegisterAdries\Response\ResponseFactory
 */
class ResponseFactoryTest extends TestCase
{
    public function testCreateResponse(): void
    {
        $factory = new ResponseFactory();
        $response = $factory->createResponse(
            RegisterResource::createUnit(),
            [
                'records' => [
                    ['objectId' => 22],
                    ['objectId' => 33]
                ],
                'total' => 20
            ]
        );

        self::assertCount(2, $response->getRecords());
        self::assertEquals(20, $response->getTotal());
    }
}
