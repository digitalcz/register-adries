<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Response;

final class County extends Record
{
    /**
     * Kód okresu, obvykle zodpovedá kódu v číselníku CL000024
     * @var string|null
     */
    private $countyCode;

    /**
     * Názov okresu
     * @var string|null
     */
    private $countyName;

    /**
     * Identifikátor (Region/objectId) nadradeného kraja
     * @var int|null
     */
    private $regionIdentifier;
    /**
     * @param array<string, mixed> $record
     */
    public function __construct(array $record)
    {
        parent::__construct($record);
        $this->countyCode = $this->stringOrNull($record['countyCode'] ?? null);
        $this->countyName = $this->stringOrNull($record['countyName'] ?? null);
        $this->regionIdentifier = $this->intOrNull($record['regionIdentifier'] ?? null);
    }

    /**
     * @return string|null
     */
    public function getCountyCode(): ?string
    {
        return $this->countyCode;
    }

    /**
     * @return string|null
     */
    public function getCountyName(): ?string
    {
        return $this->countyName;
    }

    /**
     * @return int|null
     */
    public function getRegionIdentifier(): ?int
    {
        return $this->regionIdentifier;
    }
}
