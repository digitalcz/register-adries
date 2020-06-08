<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Http;

use DigitalCz\RegisterAdries\Request\RegisterRequest;
use Psr\Http\Message\RequestInterface;

interface RegisterHttpFactoryInterface
{
    public function create(RegisterRequest $query): RequestInterface;
}
