<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Http;

use DigitalCz\RegisterAdries\RegisterResource;
use DigitalCz\RegisterAdries\Request\RegisterRequest;
use DigitalCz\RegisterAdries\Request\RegisterRequestCondition;
use DigitalCz\RegisterAdries\Response\ResponseFactory;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Mock\Client;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

/**
 * @covers \DigitalCz\RegisterAdries\Http\RegisterClient
 */
class RegisterClientTest extends TestCase
{
    public function testSimpleRequest(): void
    {
        $request = new RegisterRequest(RegisterResource::createRegion());

        $httpClient = new Client();
        $httpResponse = $this->createMock(ResponseInterface::class);
        $httpResponse
            ->method('getStatusCode')
            ->willReturn(200);
        $httpResponse
            ->method('getBody')
            ->willReturn(file_get_contents(__DIR__ . '/../Dummy/Responses/regions.yaml'));
        $httpClient->addResponse($httpResponse);

        $registerHttpFactory = new RegisterHttpFactory(
            Psr17FactoryDiscovery::findRequestFactory(),
            Psr17FactoryDiscovery::findStreamFactory()
        );

        $client = new RegisterClient($httpClient, $registerHttpFactory, new ResponseFactory());

        $response = $client->request($request);

        self::assertCount(1, $httpClient->getRequests());
        self::assertCount(5, $response->getRecords());
        self::assertEquals(20, $response->getTotal());
    }

    public function testSqlRequest(): void
    {
        $request = new RegisterRequest(RegisterResource::createRegion());
        $request->addCondition(new RegisterRequestCondition('foo', 'bar', RegisterRequestCondition::LT));

        $httpClient = new Client();

        // sql Request
        $httpResponse = $this->createMock(ResponseInterface::class);
        $httpResponse->method('getStatusCode')->willReturn(200);
        $httpResponse->method('getBody')->willReturn(file_get_contents(__DIR__ . '/../Dummy/Responses/regions.yaml'));
        $httpClient->addResponse($httpResponse);

        // count request
        $countHttpResponse = $this->createMock(ResponseInterface::class);
        $countHttpResponse->method('getStatusCode')->willReturn(200);
        $countHttpResponse->method('getBody')->willReturn(json_encode(['result' => ['records' => [['count' => 20]]]]));
        $httpClient->addResponse($countHttpResponse);

        $registerHttpFactory = new RegisterHttpFactory(
            Psr17FactoryDiscovery::findRequestFactory(),
            Psr17FactoryDiscovery::findStreamFactory()
        );

        $client = new RegisterClient($httpClient, $registerHttpFactory, new ResponseFactory());

        $response = $client->request($request);

        self::assertCount(2, $httpClient->getRequests());
        self::assertCount(5, $response->getRecords());
        self::assertEquals(20, $response->getTotal());
    }

    public function testRequestFail(): void
    {
        $resource = RegisterResource::createRegion();
        $request = new RegisterRequest($resource);

        $httpClient = new Client();
        $httpResponse = $this->createMock(ResponseInterface::class);
        $httpResponse
            ->method('getStatusCode')
            ->willReturn(500);
        $httpClient->addResponse($httpResponse);

        $registerHttpFactory = new RegisterHttpFactory(
            Psr17FactoryDiscovery::findRequestFactory(),
            Psr17FactoryDiscovery::findStreamFactory()
        );

        $client = new RegisterClient($httpClient, $registerHttpFactory, new ResponseFactory());

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Request failed');
        $client->request($request);
    }

    public function testInvalidResponse(): void
    {
        $request = new RegisterRequest(RegisterResource::createRegion());

        $httpClient = new Client();
        $httpResponse = $this->createMock(ResponseInterface::class);
        $httpResponse
            ->method('getStatusCode')
            ->willReturn(200);
        $httpResponse
            ->method('getBody')
            ->willReturn('/'); // invalid json
        $httpClient->addResponse($httpResponse);

        $registerHttpFactory = new RegisterHttpFactory(
            Psr17FactoryDiscovery::findRequestFactory(),
            Psr17FactoryDiscovery::findStreamFactory()
        );

        $client = new RegisterClient($httpClient, $registerHttpFactory, new ResponseFactory());

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Failed to parse api result');
        $client->request($request);
    }

    public function testInvalidResult(): void
    {
        $request = new RegisterRequest(RegisterResource::createRegion());

        $httpClient = new Client();
        $httpResponse = $this->createMock(ResponseInterface::class);
        $httpResponse
            ->method('getStatusCode')
            ->willReturn(200);
        $httpResponse
            ->method('getBody')
            ->willReturn(json_encode(['status' => 'failed']));
        $httpClient->addResponse($httpResponse);

        $registerHttpFactory = new RegisterHttpFactory(
            Psr17FactoryDiscovery::findRequestFactory(),
            Psr17FactoryDiscovery::findStreamFactory()
        );

        $client = new RegisterClient($httpClient, $registerHttpFactory, new ResponseFactory());

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Invalid result received');
        $client->request($request);
    }
}
