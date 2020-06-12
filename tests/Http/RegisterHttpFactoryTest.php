<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Http;

use DigitalCz\RegisterAdries\RegisterResource;
use DigitalCz\RegisterAdries\Request\RegisterRequest;
use Http\Discovery\Psr17FactoryDiscovery;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigitalCz\RegisterAdries\Http\RegisterHttpFactory
 */
class RegisterHttpFactoryTest extends TestCase
{
    public function testCreateSimpleRequest(): void
    {
        $registerHttpFactory = new RegisterHttpFactory(
            Psr17FactoryDiscovery::findRequestFactory(),
            Psr17FactoryDiscovery::findStreamFactory()
        );

        $request = new RegisterRequest(RegisterResource::createRegion());
        $httpRequest = $registerHttpFactory->createSimpleRequest($request);

        self::assertEquals('https://data.gov.sk/api/action/datastore_search', (string) $httpRequest->getUri());
        self::assertEquals('application/json', $httpRequest->getHeaderLine('Accept'));
        self::assertEquals('application/json', $httpRequest->getHeaderLine('Content-Type'));
        self::assertEquals(json_encode($request->asArray()), (string) $httpRequest->getBody());
    }

    public function testCreateSqlCountRequest(): void
    {
        $registerHttpFactory = new RegisterHttpFactory(
            Psr17FactoryDiscovery::findRequestFactory(),
            Psr17FactoryDiscovery::findStreamFactory()
        );

        $request = new RegisterRequest(RegisterResource::createRegion());
        $httpRequest = $registerHttpFactory->createSqlCountRequest($request);

        self::assertEquals('https://data.gov.sk/api/action/datastore_search_sql', (string) $httpRequest->getUri());
        self::assertEquals('application/json', $httpRequest->getHeaderLine('Accept'));
        self::assertEquals('application/json', $httpRequest->getHeaderLine('Content-Type'));
        self::assertEquals(json_encode(['sql' => $request->asSqlCount()]), (string) $httpRequest->getBody());
    }

    public function testCreateSqlRequest(): void
    {
        $registerHttpFactory = new RegisterHttpFactory(
            Psr17FactoryDiscovery::findRequestFactory(),
            Psr17FactoryDiscovery::findStreamFactory()
        );

        $request = new RegisterRequest(RegisterResource::createRegion());
        $httpRequest = $registerHttpFactory->createSqlRequest($request);

        self::assertEquals('https://data.gov.sk/api/action/datastore_search_sql', (string) $httpRequest->getUri());
        self::assertEquals('application/json', $httpRequest->getHeaderLine('Accept'));
        self::assertEquals('application/json', $httpRequest->getHeaderLine('Content-Type'));
        self::assertEquals(json_encode(['sql' => $request->asSql()]), (string) $httpRequest->getBody());
    }
}
