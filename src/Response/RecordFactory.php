<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Response;

use DigitalCz\RegisterAdries\RegisterResource;

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
     * @param array<int, array<string, mixed>> $results
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
        return self::$resourceToRecordClassMap[$resource->getName()];
    }
}
