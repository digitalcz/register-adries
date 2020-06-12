<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Response;

use PHPUnit\Framework\TestCase;

/**
 * @covers \DigitalCz\RegisterAdries\Response\Building
 */
class BuildingTest extends TestCase
{
    public function testConstruct(): void
    {
        $record = [
            'propertyRegistrationNumber'  => '5888',
            'buildingName'                => 'Soud',
            'containsFlats'               => true,
            'buildingPurposeCodelistCode' => 'foo',
            'buildingPurposeCode'         => 'bar',
            'buildingPurposeName'         => 'baz',
            'buildingTypeCodelistCode'    => 'moo',
            'buildingTypeCode'            => '555',
            'buildingTypeName'            => 'bar',
            'municipalityIdentifier'      => '69',
            'districtIdentifier'          => '420',
        ];

        $building = new Building($record);

        self::assertSame((int) $record['propertyRegistrationNumber'], $building->getPropertyRegistrationNumber());
        self::assertSame($record['buildingName'], $building->getBuildingName());
        self::assertSame($record['containsFlats'], $building->getContainsFlats());
        self::assertSame($record['buildingPurposeCodelistCode'], $building->getBuildingPurposeCodelistCode());
        self::assertSame($record['buildingPurposeCode'], $building->getBuildingPurposeCode());
        self::assertSame($record['buildingPurposeName'], $building->getBuildingPurposeName());
        self::assertSame($record['buildingTypeCodelistCode'], $building->getBuildingTypeCodelistCode());
        self::assertSame((int) $record['buildingTypeCode'], $building->getBuildingTypeCode());
        self::assertSame($record['buildingTypeName'], $building->getBuildingTypeName());
        self::assertSame((int) $record['municipalityIdentifier'], $building->getMunicipalityIdentifier());
        self::assertSame((int) $record['districtIdentifier'], $building->getDistrictIdentifier());
    }
}
