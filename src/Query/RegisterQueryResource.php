<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Query;

use InvalidArgumentException;

final class RegisterQueryResource
{
    private const REGIONS = 'regions';
    private const DISTRICTS = 'districts';
    private const CITIES = 'cities';
    private const CITY_BOROUGHS = 'city-boroughs';
    private const STREETS = 'streets';
    private const APARTMENTS = 'apartments';
    private const BUILDINGS = 'buildings';
    private const ENTRANCES = 'entrances';

    /**
     * @var string[]
     */
    private static $ids = [
        self::REGIONS => '3bbb0b04-8732-4099-b074-c7bd8f8fa080',
        self::DISTRICTS => '1829233e-53f3-4c6a-9ad6-b27f33ec7550',
        self::CITIES => '15262453-4a0f-4cce-a9e4-7709e135e4b8',
        self::CITY_BOROUGHS => 'cc20ba54-79e5-4232-a129-6af5e75e3d85',
        self::STREETS => 'fc7dc622-a728-4e11-88b1-ee305ceaa896',
        self::APARTMENTS => 'ea415386-b3cc-44ed-bd9a-7638df4d2e9a',
        self::BUILDINGS => '2ba406d0-5ce5-472d-ba75-5e04f05be1c1',
        self::ENTRANCES => 'b89a3dd3-0398-41bc-8c55-5a17617247ea',
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

    public static function createRegions(): self
    {
        return new self(self::REGIONS);
    }

    public function getName(): string
    {
        return $this->resource;
    }

    public function getId(): string
    {
        return self::$ids[$this->resource];
    }

    private function guardResource(string $resource): void
    {
        if (!array_key_exists($resource, self::$ids)) {
            throw new InvalidArgumentException('Unknown resource ' . $resource);
        }
    }
}
