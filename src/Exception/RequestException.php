<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Exception;

use Psr\Http\Message\ResponseInterface;

class RequestException extends RuntimeException
{
    public static function requestFailed(ResponseInterface $httpResponse): self
    {
        $bodyContents = (string) $httpResponse->getBody();
        $parsedBody = json_decode($bodyContents, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            $error = json_encode($parsedBody['error'] ?? $parsedBody) ?: $bodyContents;
        } else {
            $error = $bodyContents;
        }

        return new self($error, $httpResponse->getStatusCode());
    }

    public static function invalidResponse(string $message): self
    {
        return new self(sprintf('Invalid response from data.gov.sk: %s', $message));
    }

    public static function encodingFailed(string $message): self
    {
        return new self(sprintf('Encoding of body failed: %s', $message));
    }
}
