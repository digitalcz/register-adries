<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Response;

final class Unit extends Record
{
    /**
     * Číslo bytu
     * @var string|null
     */
    private $unitNumber;

    /**
     * Podlažie
     * @var int|null
     */
    private $floor;

    /**
     * Identifikátor vchodu (orientačného čísla)
     * @var int|null
     */
    private $buildingNumberIdentifier;

    /**
     * @param array<string, mixed> $record
     */
    public function __construct(array $record)
    {
        parent::__construct($record);
        $this->unitNumber = $this->stringOrNull($record['unitNumber'] ?? null);
        $this->floor = $this->intOrNull($record['floor'] ?? null);
        $this->buildingNumberIdentifier = $this->intOrNull($record['buildingNumberIdentifier'] ?? null);
    }

    /**
     * @return string|null
     */
    public function getUnitNumber(): ?string
    {
        return $this->unitNumber;
    }

    /**
     * @return int|null
     */
    public function getFloor(): ?int
    {
        return $this->floor;
    }

    /**
     * @return int|null
     */
    public function getBuildingNumberIdentifier(): ?int
    {
        return $this->buildingNumberIdentifier;
    }
}
