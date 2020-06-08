<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Request;

use DigitalCz\RegisterAdries\Http\RegisterClient;
use DigitalCz\RegisterAdries\RegisterResource;
use DigitalCz\RegisterAdries\Response\Response;

class RegisterRequestBuilder
{
    /**
     * @var RegisterClient
     */
    private $client;

    /**
     * @var RegisterResource
     */
    private $resource;

    /**
     * @var RegisterRequestCondition[]
     */
    private $conditions = [];

    /**
     * @var int
     */
    private $limit = 100;

    /**
     * @var int
     */
    private $offset = 0;

    public function __construct(RegisterClient $client)
    {
        $this->client = $client;
    }

    public function regions(): self
    {
        return $this->setResource(RegisterResource::createRegion());
    }

    public function counties(): self
    {
        return $this->setResource(RegisterResource::createCounty());
    }

    public function municipalities(): self
    {
        return $this->setResource(RegisterResource::createMunicipality());
    }

    public function districts(): self
    {
        return $this->setResource(RegisterResource::createDistrict());
    }

    public function streets(): self
    {
        return $this->setResource(RegisterResource::createStreet());
    }

    public function units(): self
    {
        return $this->setResource(RegisterResource::createUnit());
    }

    public function buildings(): self
    {
        return $this->setResource(RegisterResource::createBuilding());
    }

    public function entrances(): self
    {
        return $this->setResource(RegisterResource::createEntrance());
    }

    public function limit(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    public function offset(int $offset): self
    {
        $this->offset = $offset;

        return $this;
    }

    public function execute(): Response
    {
        return $this->client->request($this->getQuery());
    }

    public function getQuery(): RegisterRequest
    {
        $query = new RegisterRequest($this->resource);
        $query->setConditions($this->conditions);
        $query->setLimit($this->limit);
        $query->setOffset($this->offset);

        return $query;
    }

    private function setResource(RegisterResource $resource): self
    {
        $this->resource = $resource;

        return $this;
    }
}
