<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Request;

use DigitalCz\RegisterAdries\RegisterResource;

class RegisterRequest
{
    /**
     * @var RegisterResource
     */
    private $resource;

    /**
     * @var RegisterRequestConditions
     */
    private $conditions;

    /**
     * @var int
     */
    private $limit = 100;
    /**
     * @var int
     */
    private $offset = 0;

    public function __construct(RegisterResource $resource)
    {
        $this->resource = $resource;
        $this->conditions = new RegisterRequestConditions();
    }

    public function addCondition(RegisterRequestCondition $condition): void
    {
        $this->conditions->add($condition);
    }

    /**
     * @param RegisterRequestCondition[] $conditions
     */
    public function setConditions(array $conditions): void
    {
        foreach ($conditions as $condition) {
            $this->addCondition($condition);
        }
    }

    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $array = [
            'resource_id' => $this->resource->getId(),
            'limit' => $this->limit,
            'offset' => $this->offset
        ];

        if ($this->conditions->count() > 0) {
            $array['filters'] = $this->conditions->toArray();
        }

        return $array;
    }
}
