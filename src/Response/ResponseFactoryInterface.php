<?php

namespace DigitalCz\RegisterAdries\Response;

interface ResponseFactoryInterface
{
    /**
     * @param array<string, mixed> $result
     */
    public function createResponse(array $result): Response;
}
