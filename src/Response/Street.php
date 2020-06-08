<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Response;

final class Street extends Record
{
    /**
     * Názov
     * @var string|null
     */
    private $streetName;

    /**
     * Buď identifikátor obce alebo identifikátory mestských častí, cez ktoré ulica prechádza
     * @var int[]|null
     */
    private $municipalityIdentifiers;

    /**
     * Zoznam identifikátorov častí obce, cez ktoré ulica prechádza
     * @var int[]|null
     */
    private $districtIdentifiers;

    /**
     * @param array<string, mixed> $record
     */
    public function __construct(array $record)
    {
        parent::__construct($record);
        $this->streetName = $this->stringOrNull($record['streetName'] ?? null);
        $this->municipalityIdentifiers = $this->arrayOrNull($record['municipalityIdentifiers'] ?? null);
        $this->districtIdentifiers = $this->arrayOrNull($record['districtIdentifiers'] ?? null);
    }

    /**
     * @return string|null
     */
    public function getStreetName(): ?string
    {
        return $this->streetName;
    }

    /**
     * @return int[]|null
     */
    public function getMunicipalityIdentifiers(): ?array
    {
        return $this->municipalityIdentifiers;
    }

    /**
     * @return int[]|null
     */
    public function getDistrictIdentifiers(): ?array
    {
        return $this->districtIdentifiers;
    }
}
