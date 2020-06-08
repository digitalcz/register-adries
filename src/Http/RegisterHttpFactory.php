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
    private const SEARCH_URI_SQL = 'https://data.gov.sk/api/action/datastore_search_sql';

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

    public function createSimpleRequest(RegisterRequest $request): RequestInterface
    {
        return $this->requestFactory
            ->createRequest('POST', self::SEARCH_URI)
            ->withBody($this->encodeBody($request->asArray()))
            ->withHeader('Accept', 'application/json')
            ->withHeader('Content-Type', 'application/json');
    }

    public function createSqlRequest(RegisterRequest $request): RequestInterface
    {
        $sql = $request->asSql();
        return $this->requestFactory
            ->createRequest('POST', self::SEARCH_URI_SQL)
            ->withBody($this->encodeBody(['sql' => $sql]))
            ->withHeader('Accept', 'application/json')
            ->withHeader('Content-Type', 'application/json');
    }

    public function createSqlCountRequest(RegisterRequest $request): RequestInterface
    {
        $sql = $request->asSqlCount();
        return $this->requestFactory
            ->createRequest('POST', self::SEARCH_URI_SQL)
            ->withBody($this->encodeBody(['sql' => $sql]))
            ->withHeader('Accept', 'application/json')
            ->withHeader('Content-Type', 'application/json');
    }

    /**
     * @param array<mixed> $data
     */
    private function encodeBody(array $data): StreamInterface
    {
        $content = json_encode($data);

        if ($content === false) {
            throw new RuntimeException('Json encoding failure');
        }

        return $this->streamFactory->createStream($content);
    }
}
