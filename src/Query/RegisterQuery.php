<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Query;

class RegisterQuery
{
    /**
     * @var RegisterQueryResource
     */
    private $resource;

    /**
     * @var RegisterQueryConditions
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

    public function __construct(RegisterQueryResource $resource)
    {
        $this->resource = $resource;
        $this->conditions = new RegisterQueryConditions();
    }

    public function addCondition(RegisterQueryCondition $condition): void
    {
        $this->conditions[] = $condition;
    }

    /**
     * @param RegisterQueryCondition[] $conditions
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
            'resource' => $this->resource->getId(),
            'limit' => $this->limit,
            'offset' => $this->offset
        ];

        if ($this->conditions->count() > 0) {
            $array['filters'] = $this->conditions->toArray();
        }

        return $array;
    }
}
