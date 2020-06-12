<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Response;

/**
 * Obsahuje informácie o budovách (súpisných číslach) v SR.
 *
 * @see https://data.gov.sk/dataset/register-adries-register-budov
 */
final class Building extends Record
{
    /**
     * Súpisné číslo.
     *
     * @var int|null
     */
    private $propertyRegistrationNumber;

    /**
     * Bližšie určenie miesta v rámci budovy, uvádza sa iba hodnota "byt".
     *
     * @var string|null
     */
    private $buildingName;

    /**
     * Atribút, nachádzajú sa v budove byty:
     * true = v budove sa nachádzajú byty
     * false = v budove sa byty nenachádzajú.
     *
     * @var bool|null
     */
    private $containsFlats;

    /**
     * Identifikátor číselníka Účel budovy. Vždy CL010142.
     *
     * @var string|null
     */
    private $buildingPurposeCodelistCode;

    /**
     * Údaje o spôsobe využívania budovy, účel budovy, kód podľa číselníka CL010142.
     *
     * @var string|null
     */
    private $buildingPurposeCode;

    /**
     * Účel budovy, názov podľa príslušného kódu podľa číselníka CL010142.
     *
     * @var string|null
     */
    private $buildingPurposeName;

    /**
     * Identifikátor číselníka Druhov stavieb (budov). Vždy CL010143.
     *
     * @var string|null
     */
    private $buildingTypeCodelistCode;

    /**
     * Druh stavby, názov podľa príslušného kódu podľa číselníka CL010143.
     *
     * @var string|null
     */
    private $buildingTypeName;

    /**
     * Kód druhu stavby (budovy) podľa číselníka CL010143.
     *
     * @var int|null
     */
    private $buildingTypeCode;

    /**
     * Identifikátor (Municipality/objectId) nadradenej obce.
     *
     * @var int|null
     */
    private $municipalityIdentifier;

    /**
     * Identifikátor (District/objectId) nadradenej časti obce.
     *
     * @var int|null
     */
    private $districtIdentifier;

    /**
     * @param array<string, mixed> $record
     */
    public function __construct(array $record)
    {
        parent::__construct($record);
        $this->propertyRegistrationNumber = $this->intOrNull($record['propertyRegistrationNumber'] ?? null);
        $this->buildingName = $this->stringOrNull($record['buildingName'] ?? null);
        $this->containsFlats = $this->boolOrNull($record['containsFlats'] ?? null);
        $this->buildingPurposeCodelistCode = $this->stringOrNull($record['buildingPurposeCodelistCode'] ?? null);
        $this->buildingPurposeCode = $this->stringOrNull($record['buildingPurposeCode'] ?? null);
        $this->buildingPurposeName = $this->stringOrNull($record['buildingPurposeName'] ?? null);
        $this->buildingTypeCodelistCode = $this->stringOrNull($record['buildingTypeCodelistCode'] ?? null);
        $this->buildingTypeCode = $this->intOrNull($record['buildingTypeCode'] ?? null);
        $this->buildingTypeName = $this->stringOrNull($record['buildingTypeName'] ?? null);
        $this->municipalityIdentifier = $this->intOrNull($record['municipalityIdentifier'] ?? null);
        $this->districtIdentifier = $this->intOrNull($record['districtIdentifier'] ?? null);
    }

    /**
     * @return int|null
     */
    public function getPropertyRegistrationNumber(): ?int
    {
        return $this->propertyRegistrationNumber;
    }

    /**
     * @return string|null
     */
    public function getBuildingName(): ?string
    {
        return $this->buildingName;
    }

    /**
     * @return bool|null
     */
    public function getContainsFlats(): ?bool
    {
        return $this->containsFlats;
    }

    /**
     * @return string|null
     */
    public function getBuildingPurposeCodelistCode(): ?string
    {
        return $this->buildingPurposeCodelistCode;
    }

    /**
     * @return string|null
     */
    public function getBuildingPurposeCode(): ?string
    {
        return $this->buildingPurposeCode;
    }

    /**
     * @return string|null
     */
    public function getBuildingPurposeName(): ?string
    {
        return $this->buildingPurposeName;
    }

    /**
     * @return string|null
     */
    public function getBuildingTypeCodelistCode(): ?string
    {
        return $this->buildingTypeCodelistCode;
    }

    /**
     * @return string|null
     */
    public function getBuildingTypeName(): ?string
    {
        return $this->buildingTypeName;
    }

    /**
     * @return int|null
     */
    public function getBuildingTypeCode(): ?int
    {
        return $this->buildingTypeCode;
    }

    /**
     * @return int|null
     */
    public function getMunicipalityIdentifier(): ?int
    {
        return $this->municipalityIdentifier;
    }

    /**
     * @return int|null
     */
    public function getDistrictIdentifier(): ?int
    {
        return $this->districtIdentifier;
    }
}
