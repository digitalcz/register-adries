<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Response;

use DateTime;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigitalCz\RegisterAdries\Response\Record
 */
class RecordTest extends TestCase
{
    public function testConstruct(): void
    {
        $record = [
            '_id' => 123,
            'changeId' => '234',
            'changedAt' => '1000-01-01T00:00:00',
            'databaseOperation' => 'INSERT',
            'objectId' => '1',
            'versionId' => '1',
            'createdReason' => 'CREATE',
            'validFrom' => '1000-01-01T00:00:00',
            'validTo' => '3000-01-01T00:00:00',
            'effectiveDate' => '1996-07-24',
            'codelistCode' => 'CL000023',
        ];

        $dummyClass = new class() extends Record {
        };
        $dummy = new $dummyClass($record);

        self::assertSame((int)$record['_id'], $dummy->getId());
        self::assertSame((int)$record['changeId'], $dummy->getChangeId());
        self::assertEquals(new DateTime($record['changedAt']), $dummy->getChangedAt());
        self::assertSame($record['databaseOperation'], $dummy->getDatabaseOperation());
        self::assertSame((int)$record['objectId'], $dummy->getObjectId());
        self::assertSame((int)$record['versionId'], $dummy->getVersionId());
        self::assertSame($record['createdReason'], $dummy->getCreatedReason());
        self::assertEquals(new DateTime($record['validFrom']), $dummy->getValidFrom());
        self::assertEquals(new DateTime($record['validTo']), $dummy->getValidTo());
        self::assertEquals(new DateTime($record['effectiveDate']), $dummy->getEffectiveDate());
        self::assertSame($record['codelistCode'], $dummy->getCodelistCode());
    }
}
