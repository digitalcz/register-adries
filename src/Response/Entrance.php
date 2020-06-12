<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Response;

use DateTimeImmutable;

/**
 * Obsahuje informácie o vchodoch (orientačných číslach) v SR.
 *
 * @see https://data.gov.sk/dataset/register-adries-register-vchodov
 */
final class Entrance extends Record
{
    /**
     * Orientačné číslo vchodu.
     *
     * @var string|null
     */
    private $buildingNumber;

    /**
     * Identifikátor adresy.
     *
     * @var string|null
     */
    private $buildingIndex;

    /**
     * @var string|null
     */
    private $postalCode;

    /**
     * Súradnice zemepisnej šírky (ETRS89).
     *
     * @var string|null
     */
    private $axisB;

    /**
     * Súradnice zemepisnej dĺžky (ETRS89).
     *
     * @var string|null
     */
    private $axisL;

    /**
     * Identifikátor budovy (PropertyRegistrationNumber/objectId).
     *
     * @var int|null
     */
    private $propertyRegistrationNumberIdentifier;

    /**
     * Identifikátor (StreetName/objectId) ulice.
     *
     * @var int|null
     */
    private $streetNameIdentifier;

    /**
     * Dátum a čas verifikovania adresy.
     *
     * @var DateTimeImmutable|null
     */
    private $verifiedAt;

    /**
     * @param array<string, mixed> $record
     */
    public function __construct(array $record)
    {
        parent::__construct($record);
        $this->buildingNumber = $this->stringOrNull($record['buildingNumber'] ?? null);
        $this->buildingIndex = $this->stringOrNull($record['buildingIndex'] ?? null);
        $this->postalCode = $this->stringOrNull($record['postalCode'] ?? null);
        $this->axisB = $this->stringOrNull($record['axisB'] ?? null);
        $this->axisL = $this->stringOrNull($record['axisL'] ?? null);
        $this->streetNameIdentifier = $this->intOrNull($record['streetNameIdentifier'] ?? null);
        $this->verifiedAt = $this->dateTimeOrNull($record['verifiedAt'] ?? null);
        $this->propertyRegistrationNumberIdentifier =
            $this->intOrNull($record['propertyRegistrationNumberIdentifier'] ?? null);
    }

    /**
     * @return string|null
     */
    public function getBuildingNumber(): ?string
    {
        return $this->buildingNumber;
    }

    /**
     * @return string|null
     */
    public function getBuildingIndex(): ?string
    {
        return $this->buildingIndex;
    }

    /**
     * @return string|null
     */
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    /**
     * @return string|null
     */
    public function getAxisB(): ?string
    {
        return $this->axisB;
    }

    /**
     * @return string|null
     */
    public function getAxisL(): ?string
    {
        return $this->axisL;
    }

    /**
     * @return int|null
     */
    public function getPropertyRegistrationNumberIdentifier(): ?int
    {
        return $this->propertyRegistrationNumberIdentifier;
    }

    /**
     * @return int|null
     */
    public function getStreetNameIdentifier(): ?int
    {
        return $this->streetNameIdentifier;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getVerifiedAt(): ?DateTimeImmutable
    {
        return $this->verifiedAt;
    }
}
