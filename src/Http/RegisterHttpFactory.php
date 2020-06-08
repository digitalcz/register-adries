<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Http;

use DigitalCz\RegisterAdries\Request\RegisterRequest;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;
use RuntimeException;

class RegisterHttpFactory implements RegisterHttpFactoryInterface
{
    private const SEARCH_URI = 'https://data.gov.sk/api/action/datastore_search';

    /**
     * @var RequestFactoryInterface
     */
    private $requestFactory;

    /**
     * @var StreamFactoryInterface
     */
    private $streamFactory;

    public function __construct(RequestFactoryInterface $requestFactory, StreamFactoryInterface $streamFactory)
    {
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
    }

    public function create(RegisterRequest $query): RequestInterface
    {
        return $this->requestFactory
            ->createRequest('POST', self::SEARCH_URI)
            ->withBody($this->createBody($query))
            ->withHeader('Accept', 'application/json')
            ->withHeader('Content-Type', 'application/json');
    }

    private function createBody(RegisterRequest $query): StreamInterface
    {
        $content = json_encode($query->toArray());

        if ($content === false) {
            throw new RuntimeException('Json encoding failure');
        }

        return $this->streamFactory->createStream($content);
    }
}
