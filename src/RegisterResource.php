<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries;

use InvalidArgumentException;

final class RegisterResource
{
    public const REGION = 'region';
    public const COUNTY = 'county';
    public const MUNICIPALITY = 'municipality';
    public const DISTRICT = 'district';
    public const STREET = 'street';
    public const UNIT = 'unit';
    public const BUILDING = 'building';
    public const ENTRANCE = 'entrance';

    /**
     * @var array<string, string>
     */
    private static $ids = [
        self::REGION => '3bbb0b04-8732-4099-b074-c7bd8f8fa080',
        self::COUNTY => '1829233e-53f3-4c6a-9ad6-b27f33ec7550',
        self::MUNICIPALITY => '15262453-4a0f-4cce-a9e4-7709e135e4b8',
        self::DISTRICT => 'cc20ba54-79e5-4232-a129-6af5e75e3d85',
        self::STREET => 'fc7dc622-a728-4e11-88b1-ee305ceaa896',
        self::UNIT => 'ea415386-b3cc-44ed-bd9a-7638df4d2e9a',
        self::BUILDING => '2ba406d0-5ce5-472d-ba75-5e04f05be1c1',
        self::ENTRANCE => 'b89a3dd3-0398-41bc-8c55-5a17617247ea',
    ];

    /**
     * @var string
     */
    private $resource;

    private function __construct(string $resource)
    {
        $this->guardResource($resource);

        $this->resource = $resource;
    }

    public static function createRegion(): self
    {
        return new self(self::REGION);
    }

    public static function createCounty(): self
    {
        return new self(self::COUNTY);
    }

    public static function createMunicipality(): self
    {
        return new self(self::MUNICIPALITY);
    }

    public static function createDistrict(): self
    {
        return new self(self::DISTRICT);
    }

    public static function createStreet(): self
    {
        return new self(self::STREET);
    }

    public static function createUnit(): self
    {
        return new self(self::UNIT);
    }

    public static function createBuilding(): self
    {
        return new self(self::BUILDING);
    }

    public static function createEntrance(): self
    {
        return new self(self::ENTRANCE);
    }

    public function getId(): string
    {
        return self::$ids[$this->resource];
    }

    public function getName(): string
    {
        return $this->resource;
    }

    private function guardResource(string $resource): void
    {
        if (!array_key_exists($resource, self::$ids)) {
            throw new InvalidArgumentException('Unknown resource ' . $resource);
        }
    }
}
