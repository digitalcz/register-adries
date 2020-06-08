<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Response;

final class District extends Record
{
    /**
     * Atribút pre jedinečné číslovanie budov v časti obce:
     * true = jedinečné číslovanie
     * false = bez jedinečného číslovania
     *
     * @var bool|null
     */
    private $uniqueNumbering;

    /**
     * Údaj o časti obce, obvykle zodpovedá kódu v číselníku CL010141
     * @var int|null
     */
    private $districtCode;

    /**
     * Časť názov obce
     * @var string|null
     */
    private $districtName;

    /**
     * Identifikátor (Municipality/objectId) nadradenej obce
     * @var int|null
     */
    private $municipalityIdentifier;

    /**
     * @param array<string, mixed> $record
     */
    public function __construct(array $record)
    {
        parent::__construct($record);
        $this->uniqueNumbering = $this->boolOrNull($record['uniqueNumbering'] ?? null);
        $this->districtCode = $this->intOrNull($record['districtCode'] ?? null);
        $this->districtName = $this->stringOrNull($record['districtName'] ?? null);
        $this->municipalityIdentifier = $this->intOrNull($record['municipalityIdentifier'] ?? null);
    }

    /**
     * @return bool|null
     */
    public function getUniqueNumbering(): ?bool
    {
        return $this->uniqueNumbering;
    }

    /**
     * @return int|null
     */
    public function getDistrictCode(): ?int
    {
        return $this->districtCode;
    }

    /**
     * @return string|null
     */
    public function getDistrictName(): ?string
    {
        return $this->districtName;
    }

    /**
     * @return int|null
     */
    public function getMunicipalityIdentifier(): ?int
    {
        return $this->municipalityIdentifier;
    }
}
