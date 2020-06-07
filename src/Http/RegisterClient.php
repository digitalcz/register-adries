<?php declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Http;

use DigitalCz\RegisterAdries\Query\RegisterQuery;
use Http\Message\RequestFactory;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;
use RuntimeException;

class RegisterClient
{
    /**
     * @var ClientInterface
     */
    private $httpClient;
    /**
     * @var RegisterRequestFactory
     */
    private $requestFactory;

    public function __construct(ClientInterface $httpClient, RegisterRequestFactory $requestFactory)
    {
        $this->httpClient = $httpClient;
        $this->requestFactory = $requestFactory;
    }

    public function request(RegisterQuery $query)
    {
        $request = $this->requestFactory->create($query);

        return $this->httpClient->sendRequest($request);
    }
}
