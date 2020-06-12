<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Response;

/**
 * Obsahuje informácie o obciach SR. Obsahovo tento dataset zodpovedá
 * základnému číselníku CL000025 - Lokálna štatistická územná jednotka 2 - obec.
 *
 * @see https://data.gov.sk/dataset/register-adries-register-obci
 */
final class Municipality extends Record
{
    /**
     * Údaj o obci, obvykle zodpovedá kódu v číselníku CL000025.
     *
     * @var string|null
     */
    private $municipalityCode;

    /**
     * Názov obce.
     *
     * @var string|null
     */
    private $municipalityName;

    /**
     * Identifikátor (County/objectId) nadradeného okresu.
     *
     * @var int|null
     */
    private $countyIdentifier;

    /**
     * Štatút obce.
     *
     * @var string|null
     */
    private $status;

    /**
     * Identifikátor (Municipality/objectId) nadradeného mesta pre mestskú časť;
     * položka je vyplnená ak je status == MESTSKA_CAST.
     *
     * @var int|null
     */
    private $cityIdentifier;

    /**
     * @param array<string, mixed> $record
     */
    public function __construct(array $record)
    {
        parent::__construct($record);
        $this->municipalityCode = $this->stringOrNull($record['municipalityCode'] ?? null);
        $this->municipalityName = $this->stringOrNull($record['municipalityName'] ?? null);
        $this->countyIdentifier = $this->intOrNull($record['countyIdentifier'] ?? null);
        $this->status = $this->stringOrNull($record['status'] ?? null);
        $this->cityIdentifier = $this->intOrNull($record['cityIdentifier'] ?? null);
    }

    /**
     * @return string|null
     */
    public function getMunicipalityCode(): ?string
    {
        return $this->municipalityCode;
    }

    /**
     * @return string|null
     */
    public function getMunicipalityName(): ?string
    {
        return $this->municipalityName;
    }

    /**
     * @return int|null
     */
    public function getCountyIdentifier(): ?int
    {
        return $this->countyIdentifier;
    }

    /**
     * @return string
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @return int|null
     */
    public function getCityIdentifier(): ?int
    {
        return $this->cityIdentifier;
    }
}
