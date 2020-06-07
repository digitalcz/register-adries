<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries;

use DigitalCz\RegisterAdries\Http\RegisterClient;
use DigitalCz\RegisterAdries\Query\RegisterQueryBuilder;

final class RegisterAdries
{
    /**
     * @var RegisterClient
     */
    private $client;

    public function __construct(RegisterClient $client)
    {
        $this->client = $client;
    }

    public function createQueryBuilder(): RegisterQueryBuilder
    {
        return new RegisterQueryBuilder($this->client);
    }
}
