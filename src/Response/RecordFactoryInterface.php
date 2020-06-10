<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Response;

use DigitalCz\RegisterAdries\RegisterResource;

interface RecordFactoryInterface
{
    /**
     * @param array<int, array<string, mixed>> $results
     * @return Record[]
     */
    public function createFromResults(RegisterResource $resource, array $results): array;
}
