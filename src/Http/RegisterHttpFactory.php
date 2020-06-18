<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Http;

use DigitalCz\RegisterAdries\Exception\RequestException;
use DigitalCz\RegisterAdries\Request\RegisterRequest;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;

final class RegisterHttpFactory implements RegisterHttpFactoryInterface
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
        return $this->createHttpRequest(self::SEARCH_URI, $request->asArray());
    }

    public function createSqlRequest(RegisterRequest $request): RequestInterface
    {
        return $this->createHttpRequest(self::SEARCH_URI_SQL, ['sql' => $request->asSql()]);
    }

    public function createSqlCountRequest(RegisterRequest $request): RequestInterface
    {
        return $this->createHttpRequest(self::SEARCH_URI_SQL, ['sql' => $request->asSqlCount()]);
    }

    /**
     * @param array<mixed> $body
     */
    private function createHttpRequest(string $uri, array $body): RequestInterface
    {
        return $this->requestFactory
            ->createRequest('POST', $uri)
            ->withBody($this->encodeBody($body))
            ->withHeader('Accept', 'application/json')
            ->withHeader('Content-Type', 'application/json');
    }

    /**
     * @param array<mixed> $data
     */
    private function encodeBody(array $data): StreamInterface
    {
        $content = json_encode($data);

        if (json_last_error() !== JSON_ERROR_NONE || !is_string($content)) {
            throw RequestException::encodingFailed(json_last_error_msg());
        }

        return $this->streamFactory->createStream($content);
    }
}
