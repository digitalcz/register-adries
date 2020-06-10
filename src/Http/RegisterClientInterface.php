<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Http;

use DigitalCz\RegisterAdries\Request\RegisterRequest;
use DigitalCz\RegisterAdries\Response\Response;

interface RegisterClientInterface
{
    public function request(RegisterRequest $request): Response;
}
