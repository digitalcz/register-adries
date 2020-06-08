<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Http;

use DigitalCz\RegisterAdries\Request\RegisterRequest;
use DigitalCz\RegisterAdries\Response\Response;
use DigitalCz\RegisterAdries\Response\ResponseFactory;
use DigitalCz\RegisterAdries\Response\ResponseFactoryInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

class RegisterClient
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

    public function request(RegisterRequest $query): Response
    {
        $httpRequest = $this->httpFactory->create($query);
        $httpResponse = $this->httpClient->sendRequest($httpRequest);

        if ($httpResponse->getStatusCode() !== 200) {
            throw new RuntimeException('Request failed');
        }

        $contents = $httpResponse->getBody()->getContents();

        $result = json_decode($contents, true);

        if ($result === false) {
            throw new RuntimeException('Failed to parse result json');
        }

        if (!isset($result['result']) || !is_array($result['result'])) {
            throw new RuntimeException('Invalid result recieved');
        }

        return $this->responseFactory->createResponse($result['result']);
    }
}
