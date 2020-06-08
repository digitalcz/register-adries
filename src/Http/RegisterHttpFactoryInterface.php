<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Http;

use DigitalCz\RegisterAdries\Request\RegisterRequest;
use Psr\Http\Message\RequestInterface;

interface RegisterHttpFactoryInterface
{
    public function createSimpleRequest(RegisterRequest $request): RequestInterface;

    public function createSqlRequest(RegisterRequest $request): RequestInterface;

    public function createSqlCountRequest(RegisterRequest $request): RequestInterface;
}
