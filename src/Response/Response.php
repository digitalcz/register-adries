<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Response;

class Response
{
    /**
     * @var Region[]
     */
    private $records;

    /**
     * @var int|null
     */
    private $total;

    /**
     * @param array<string, mixed> $records
     */
    public function __construct(array $records, int $total)
    {
        $this->records = $records;
        $this->total = $total;
    }

    /**
     * @return Record[]
     */
    public function getRecords(): array
    {
        return $this->records;
    }

    /**
     * @return int|null
     */
    public function getTotal(): ?int
    {
        return $this->total;
    }
}
