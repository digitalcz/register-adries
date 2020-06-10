<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Response;

final class Response
{
    /**
     * @var Record[]
     */
    private $records;

    /**
     * @var int|null
     */
    private $total;

    /**
     * @param array<int, Record> $records
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

    public function getSingleRecord(): ?Record
    {
        if (count($this->records) !== 1) {
            return null;
        }

        return reset($this->records);
    }

    /**
     * @return int|null
     */
    public function getTotal(): ?int
    {
        return $this->total;
    }
}
