<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Response;

use DigitalCz\RegisterAdries\RegisterResource;
use InvalidArgumentException;
use PHPUnit\Framework\Constraint\Count;

final class RecordFactory implements RecordFactoryInterface
{
    /**
     * @var string[]
     */
    private static $resourceToRecordClassMap = [
        RegisterResource::REGION => Region::class,
        RegisterResource::COUNTY => County::class,
        RegisterResource::MUNICIPALITY => Municipality::class,
        RegisterResource::DISTRICT => District::class,
        RegisterResource::STREET => Street::class,
        RegisterResource::UNIT => Unit::class,
        RegisterResource::BUILDING => Building::class,
        RegisterResource::ENTRANCE => Entrance::class,
    ];

    /**
     * @param array<string, mixed> $results
     * @return Record[]
     */
    public function createFromResults(RegisterResource $resource, array $results): array
    {
        $recordClass = $this->getResultClass($resource);

        return array_map(
            static function (array $result) use ($recordClass) {
                return new $recordClass($result);
            },
            $results
        );
    }

    private function getResultClass(RegisterResource $resource): string
    {
        if (!array_key_exists($resource->getName(), self::$resourceToRecordClassMap)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Non-implemented resource %s on %s',
                    $resource->getName(),
                    __CLASS__
                )
            );
        }

        return self::$resourceToRecordClassMap[$resource->getName()];
    }
}
