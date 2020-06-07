<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Query;

use DigitalCz\RegisterAdries\Http\RegisterClient;
use Psr\Http\Message\ResponseInterface;

class RegisterQueryBuilder
{
    /**
     * @var RegisterClient
     */
    private $client;

    /**
     * @var RegisterQueryResource
     */
    private $resource;

    /**
     * @var RegisterQueryCondition[]
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
        $this->resource = RegisterQueryResource::createRegions();

        return $this;
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

    public function execute(): ResponseInterface
    {
        return $this->client->request($this->getQuery());
    }

    public function getQuery(): RegisterQuery
    {
        $query = new RegisterQuery($this->resource);
        $query->setConditions($this->conditions);
        $query->setLimit($this->limit);
        $query->setOffset($this->offset);

        return $query;
    }
}
