<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Response;

use DigitalCz\RegisterAdries\RegisterResource;

final class ResponseFactory implements ResponseFactoryInterface
{
    /**
     * @var RecordFactoryInterface
     */
    private $recordFactory;

    public function __construct(RecordFactoryInterface $recordFactory = null)
    {
        $this->recordFactory = $recordFactory ?? new RecordFactory();
    }

    /**
     * @param array<string, mixed> $result
     */
    public function createResponse(array $result): Response
    {
        $records = $this->createRecords($result);
        $total = (int)($result['total'] ?? 0);

        return new Response($records, $total);
    }

    /**
     * @param array<string, mixed> $result
     * @return Record[]
     */
    private function createRecords(array $result): array
    {
        $resource = RegisterResource::fromId($result['resource_id'] ?? 'null');
        return $this->recordFactory->createFromResults($resource, $result['records'] ?? []);
    }
}
