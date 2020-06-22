<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Request;

use DateTimeImmutable;
use DigitalCz\RegisterAdries\Http\RegisterClientInterface;
use DigitalCz\RegisterAdries\RegisterResource;
use DigitalCz\RegisterAdries\Response\Response;

final class RegisterRequestBuilder
{
    /**
     * @var RegisterClientInterface
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

    public function __construct(RegisterClientInterface $client)
    {
        $this->client = $client;
    }

    public function resource(string $resource): self
    {
        return $this->setResource(RegisterResource::create($resource));
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

    public function onlyValid(): self
    {
        $now = new DateTimeImmutable();
        $this->whereLt('validFrom', $now);
        $this->whereGte('validTo', $now);
        return $this;
    }

    public function whereObjectId(int $id): self
    {
        return $this->whereEq('objectId', $id);
    }

    public function whereStartsWith(string $field, string $text): self
    {
        return $this->whereLike($field, "$text%");
    }

    public function whereEndsWith(string $field, string $text): self
    {
        return $this->whereLike($field, "%$text");
    }

    /**
     * @deprecated Use whereContains instead
     */
    public function wherePartial(string $field, string $text): self
    {
        return $this->whereContains($field, $text);
    }

    public function whereContains(string $field, string $text): self
    {
        return $this->whereLike($field, "%$text%");
    }

    /**
     * @param mixed $value
     */
    public function whereLt(string $field, $value): self
    {
        return $this->where($field, $value, RegisterRequestCondition::LT);
    }

    /**
     * @param mixed $value
     */
    public function whereLte(string $field, $value): self
    {
        return $this->where($field, $value, RegisterRequestCondition::LTE);
    }

    /**
     * @param mixed $value
     */
    public function whereGt(string $field, $value): self
    {
        return $this->where($field, $value, RegisterRequestCondition::GT);
    }

    /**
     * @param mixed $value
     */
    public function whereGte(string $field, $value): self
    {
        return $this->where($field, $value, RegisterRequestCondition::GTE);
    }

    /**
     * @param mixed $value
     */
    public function whereEq(string $field, $value): self
    {
        return $this->where($field, $value, RegisterRequestCondition::EQ);
    }

    /**
     * @param mixed $value
     */
    public function whereNeq(string $field, $value): self
    {
        return $this->where($field, $value, RegisterRequestCondition::NEQ);
    }

    /**
     * @param mixed $value
     */
    public function whereLike(string $field, $value): self
    {
        return $this->where($field, $value, RegisterRequestCondition::LIKE);
    }

    /**
     * @param mixed $value
     */
    public function where(string $field, $value, string $operator): self
    {
        $this->conditions[] = new RegisterRequestCondition($field, $value, $operator);

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
