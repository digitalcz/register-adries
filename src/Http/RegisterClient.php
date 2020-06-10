<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Http;

use DigitalCz\RegisterAdries\Request\RegisterRequest;
use DigitalCz\RegisterAdries\Response\Response;
use DigitalCz\RegisterAdries\Response\ResponseFactoryInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

final class RegisterClient
{
    /**
     * @var ClientInterface
     */
    private $httpClient;

    /**
     * @var RegisterHttpFactoryInterface
     */
    private $httpFactory;

    /**
     * @var ResponseFactoryInterface
     */
    private $responseFactory;

    public function __construct(
        ClientInterface $httpClient,
        RegisterHttpFactoryInterface $httpFactory,
        ResponseFactoryInterface $responseFactory
    ) {
        $this->httpClient = $httpClient;
        $this->httpFactory = $httpFactory;
        $this->responseFactory = $responseFactory;
    }

    public function request(RegisterRequest $request): Response
    {
        if ($request->isSimple()) {
            return $this->simpleRequest($request);
        }

        return $this->sqlRequest($request);
    }

    private function simpleRequest(RegisterRequest $request): Response
    {
        $httpRequest = $this->httpFactory->createSimpleRequest($request);
        $result = $this->sendHttpRequest($httpRequest);

        return $this->responseFactory->createResponse($request->getResource(), $result);
    }

    private function sqlRequest(RegisterRequest $request): Response
    {
        // results request
        $sqlHttpRequest = $this->httpFactory->createSqlRequest($request);
        $result = $this->sendHttpRequest($sqlHttpRequest);

        // count request
        $sqlCountHttpRequest = $this->httpFactory->createSqlCountRequest($request);
        $countResult = $this->sendHttpRequest($sqlCountHttpRequest);

        // add count to results response
        $result['total']  = (int)($countResult['records'][0]['count'] ?? 0);

        return $this->responseFactory->createResponse($request->getResource(), $result);
    }

    /**
     * @return array<mixed>
     */
    private function sendHttpRequest(RequestInterface $httpRequest): array
    {
        $httpResponse = $this->httpClient->sendRequest($httpRequest);

        if ($httpResponse->getStatusCode() !== 200) {
            throw new RuntimeException('Request failed');
        }

        return $this->parseBody($httpResponse);
    }

    /**
     * @return array<mixed>
     */
    private function parseBody(ResponseInterface $httpResponse): array
    {
        $body = json_decode((string)$httpResponse->getBody(), true);

        if (!is_array($body)) {
            throw new RuntimeException('Failed to parse api result');
        }

        $result = $body['result'] ?? null;

        if (!isset($result) || !is_array($result)) {
            throw new RuntimeException('Invalid result received');
        }

        return $result;
    }
}
