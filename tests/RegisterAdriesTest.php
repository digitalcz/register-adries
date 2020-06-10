<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries;

use Generator;
use Http\Mock\Client;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * @covers \DigitalCz\RegisterAdries\RegisterAdries
 */
class RegisterAdriesTest extends TestCase
{
    /**
     * @var RegisterAdries
     */
    private $register;

    /**
     * @var Client
     */
    private $httpClient;

    /**
     * @dataProvider provideFindMethod
     */
    public function testFindMethod(string $method, RegisterResource $resource): void
    {
        $id = random_int(1, 2000);
        $this->register->$method($id);

        $request = $this->httpClient->getLastRequest();
        self::assertEquals(
            'https://data.gov.sk/api/action/datastore_search',
            (string)$request->getUri()
        );
        self::assertJson((string)$request->getBody());
        self::assertJsonStringEqualsJsonString(
            sprintf(
                "{\"resource_id\":\"%s\",\"limit\":1,\"offset\":0,\"filters\":{\"objectId\":\"%s\"}}",
                $resource->getId(),
                $id
            ),
            (string)$request->getBody()
        );
    }

    /**
     * @return Generator<array{0: string, 1: RegisterResource}>
     */
    public function provideFindMethod(): Generator
    {
        yield ['findRegion', RegisterResource::createRegion()];
        yield ['findCounty', RegisterResource::createCounty()];
        yield ['findMunicipality', RegisterResource::createMunicipality()];
        yield ['findDistrict', RegisterResource::createDistrict()];
        yield ['findStreet', RegisterResource::createStreet()];
        yield ['findUnit', RegisterResource::createUnit()];
        yield ['findBuilding', RegisterResource::createBuilding()];
        yield ['findEntrance', RegisterResource::createEntrance()];
    }

    protected function setUp(): void
    {
        $response = $this->createMock(ResponseInterface::class);
        $response
            ->method('getStatusCode')
            ->willReturn(200);
        $response
            ->method('getBody')
            ->willReturn(file_get_contents(__DIR__ . '/Dummy/Responses/regions.yaml'));

        $this->httpClient = new Client();
        $this->httpClient->addResponse($response);
        $this->register = new RegisterAdries($this->httpClient);
    }
}
