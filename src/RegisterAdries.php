<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries;

use DigitalCz\RegisterAdries\Http\RegisterClient;
use DigitalCz\RegisterAdries\Http\RegisterHttpFactory;
use DigitalCz\RegisterAdries\Request\RegisterRequestBuilder;
use DigitalCz\RegisterAdries\Response\Building;
use DigitalCz\RegisterAdries\Response\County;
use DigitalCz\RegisterAdries\Response\District;
use DigitalCz\RegisterAdries\Response\Entrance;
use DigitalCz\RegisterAdries\Response\Municipality;
use DigitalCz\RegisterAdries\Response\Region;
use DigitalCz\RegisterAdries\Response\ResponseFactory;
use DigitalCz\RegisterAdries\Response\ResponseFactoryInterface;
use DigitalCz\RegisterAdries\Response\Street;
use DigitalCz\RegisterAdries\Response\Unit;
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

    public function findRegion(int $id): ?Region
    {
        $record = $this
            ->request()
            ->regions()
            ->whereObjectId($id)
            ->limit(1)
            ->execute()
            ->getSingleRecord();

        return $record instanceof Region ? $record : null;
    }

    public function findCounty(int $id): ?County
    {
        $record = $this
            ->request()
            ->counties()
            ->whereObjectId($id)
            ->limit(1)
            ->execute()
            ->getSingleRecord();

        return $record instanceof County ? $record : null;
    }

    public function findMunicipality(int $id): ?Municipality
    {
        $record = $this
            ->request()
            ->municipalities()
            ->whereObjectId($id)
            ->limit(1)
            ->execute()
            ->getSingleRecord();

        return $record instanceof Municipality ? $record : null;
    }

    public function findDistrict(int $id): ?District
    {
        $record = $this
            ->request()
            ->districts()
            ->whereObjectId($id)
            ->limit(1)
            ->execute()
            ->getSingleRecord();

        return $record instanceof District ? $record : null;
    }

    public function findStreet(int $id): ?Street
    {
        $record = $this
            ->request()
            ->streets()
            ->whereObjectId($id)
            ->limit(1)
            ->execute()
            ->getSingleRecord();

        return $record instanceof Street ? $record : null;
    }

    public function findUnit(int $id): ?Unit
    {
        $record = $this
            ->request()
            ->units()
            ->whereObjectId($id)
            ->limit(1)
            ->execute()
            ->getSingleRecord();

        return $record instanceof Unit ? $record : null;
    }

    public function findBuilding(int $id): ?Building
    {
        $record = $this
            ->request()
            ->buildings()
            ->whereObjectId($id)
            ->limit(1)
            ->execute()
            ->getSingleRecord();

        return $record instanceof Building ? $record : null;
    }

    public function findEntrance(int $id): ?Entrance
    {
        $record = $this
            ->request()
            ->entrances()
            ->whereObjectId($id)
            ->limit(1)
            ->execute()
            ->getSingleRecord();

        return $record instanceof Entrance ? $record : null;
    }
}
