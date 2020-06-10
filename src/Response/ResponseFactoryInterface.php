<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Response;

use DigitalCz\RegisterAdries\RegisterResource;

interface ResponseFactoryInterface
{
    /**
     * @param array<string, mixed> $result
     */
    public function createResponse(RegisterResource $resource, array $result): Response;
}
