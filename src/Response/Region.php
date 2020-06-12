<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Response;

/**
 * Obsahuje informácie o krajoch SR. Kraj je najvyššia administratívna a územnosprávna
 * jednotka a jednotka štátnej správy na Slovensku. Obsahovo tento dataset zodpovedá
 * základnému číselníku CL000023 - Samosprávny kraj.
 *
 * @see https://data.gov.sk/dataset/register-adries-register-krajov
 */
final class Region extends Record
{
    /**
     * Kód kraja, obvykle zodpovedá kódu v číselníku CL000023.
     *
     * @var string|null
     */
    private $regionCode;

    /**
     * Názov kraja.
     *
     * @var string|null
     */
    private $regionName;

    /**
     * @param array<string, mixed> $record
     */
    public function __construct(array $record)
    {
        parent::__construct($record);

        $this->regionCode = $this->stringOrNull($record['regionCode'] ?? null);
        $this->regionName = $this->stringOrNull($record['regionName'] ?? null);
    }

    /**
     * @return string|null
     */
    public function getRegionCode(): ?string
    {
        return $this->regionCode;
    }

    /**
     * @return string|null
     */
    public function getRegionName(): ?string
    {
        return $this->regionName;
    }
}
