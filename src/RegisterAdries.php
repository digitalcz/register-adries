<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries;

use DigitalCz\RegisterAdries\Http\RegisterClient;
use DigitalCz\RegisterAdries\Http\RegisterHttpFactory;
use DigitalCz\RegisterAdries\Request\RegisterRequestBuilder;
use DigitalCz\RegisterAdries\Response\ResponseFactory;
use DigitalCz\RegisterAdries\Response\ResponseFactoryInterface;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

final class RegisterAdries
{
    /**
     * @var RegisterClient
     */
    private $client;

    public function __construct(
        ClientInterface $httpClient = null,
        RequestFactoryInterface $httpRequestFactory = null,
        StreamFactoryInterface $httpStreamFactory = null,
        ResponseFactoryInterface $responseFactory = null
    ) {
        $httpClient = $httpClient ?? Psr18ClientDiscovery::find();
        $httpRequestFactory = $httpRequestFactory ?? Psr17FactoryDiscovery::findRequestFactory();
        $httpStreamFactory = $httpStreamFactory ?? Psr17FactoryDiscovery::findStreamFactory();

        $httpFactory = new RegisterHttpFactory($httpRequestFactory, $httpStreamFactory);
        $responseFactory = $responseFactory ?? new ResponseFactory();

        $this->client = new RegisterClient($httpClient, $httpFactory, $responseFactory);
    }

    public function request(): RegisterRequestBuilder
    {
        return new RegisterRequestBuilder($this->client);
    }
}
