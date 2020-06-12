<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Exception;

use Nyholm\Psr7\Response;
use PHPUnit\Framework\TestCase;

class RequestExceptionTest extends TestCase
{
    public function testRequestFailed(): void
    {
        $response = new Response(409, [], json_encode([
            'success' => false,
            'error' => ['__type' => 'Validation Error']
        ]));
        $exception = RequestException::requestFailed($response);
        self::assertEquals(409, $exception->getCode());
        self::assertEquals('{"__type":"Validation Error"}', $exception->getMessage());
    }

    public function testRequestFailedWithoutErrorInResponse(): void
    {
        $response = new Response(404, [], json_encode([
            'success' => false,
        ]));
        $exception = RequestException::requestFailed($response);
        self::assertEquals(404, $exception->getCode());
        self::assertEquals('{"success":false}', $exception->getMessage());
    }

    public function testRequestFailedWithoutJsonBody(): void
    {
        $response = new Response(500, [], 'Server Error');
        $exception = RequestException::requestFailed($response);
        self::assertEquals(500, $exception->getCode());
        self::assertEquals('Server Error', $exception->getMessage());
    }

    public function testInvalidResponse(): void
    {
        $exception = RequestException::invalidResponse('Something went wrong');
        self::assertEquals(0, $exception->getCode());
        self::assertEquals('Invalid response from data.gov.sk: Something went wrong', $exception->getMessage());
    }

    public function testEncodingFailed(): void
    {
        $exception = RequestException::encodingFailed('Invalid or malformed JSON');
        self::assertEquals(0, $exception->getCode());
        self::assertEquals('Encoding of body failed: Invalid or malformed JSON', $exception->getMessage());
    }
}
