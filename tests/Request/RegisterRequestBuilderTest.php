<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries\Request;

use DigitalCz\RegisterAdries\Http\RegisterClientInterface;
use DigitalCz\RegisterAdries\RegisterResource;
use DigitalCz\RegisterAdries\Response\Response;
use Generator;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigitalCz\RegisterAdries\Request\RegisterRequestBuilder
 */
class RegisterRequestBuilderTest extends TestCase
{
    public function testResource(): void
    {
        $client = $this->createStub(RegisterClientInterface::class);
        $builder = new RegisterRequestBuilder($client);
        $builder->resource(RegisterResource::REGION);
        $query = $builder->getQuery();

        self::assertEquals(RegisterResource::REGION, $query->getResource()->getName());
    }

    /**
     * @dataProvider provideResourceMethods
     */
    public function testResourceMethods(string $method, RegisterResource $expectedResource): void
    {
        $client = $this->createStub(RegisterClientInterface::class);
        $builder = new RegisterRequestBuilder($client);
        $query = $builder->$method()->getQuery();

        self::assertEquals($expectedResource->getId(), $query->getResource()->getId());
        self::assertEquals($expectedResource->getName(), $query->getResource()->getName());
    }

    /**
     * @return Generator<int, array{0: string, 1: RegisterResource}>
     */
    public function provideResourceMethods(): Generator
    {
        yield ['regions', RegisterResource::createRegion()];
        yield ['counties', RegisterResource::createCounty()];
        yield ['municipalities', RegisterResource::createMunicipality()];
        yield ['districts', RegisterResource::createDistrict()];
        yield ['streets', RegisterResource::createStreet()];
        yield ['units', RegisterResource::createUnit()];
        yield ['buildings', RegisterResource::createBuilding()];
        yield ['entrances', RegisterResource::createEntrance()];
    }

    /**
     * @param array<int|string> $params
     * @dataProvider provideConditionMethods
     */
    public function testConditionMethods(string $method, array $params, string $expectedConditionInSql): void
    {
        $client = $this->createStub(RegisterClientInterface::class);
        $builder = new RegisterRequestBuilder($client);
        $builder->regions();
        $builder->$method(...$params);

        self::assertStringContainsString($expectedConditionInSql, $builder->getQuery()->asSql());
    }

    /**
     * @return Generator<int, array{0: string, 1: array<int|string>, 2: string}>
     */
    public function provideConditionMethods(): Generator
    {
        yield ['whereObjectId', [69], '"objectId" = \'69\''];
        yield ['whereStartsWith', ['foo', 'baz'], '"foo" LIKE \'baz%\''];
        yield ['whereEndsWith', ['foo', 'baz'], '"foo" LIKE \'%baz\''];
        yield ['wherePartial', ['foo', 'baz'], '"foo" LIKE \'%baz%\''];
        yield ['whereContains', ['foo', 'baz'], '"foo" LIKE \'%baz%\''];
        yield ['whereLt', ['foo', 'baz'], '"foo" < \'baz\''];
        yield ['whereLte', ['foo', 'baz'], '"foo" <= \'baz\''];
        yield ['whereGt', ['foo', 'baz'], '"foo" > \'baz\''];
        yield ['whereGte', ['foo', 'baz'], '"foo" >= \'baz\''];
        yield ['whereEq', ['foo', 'baz'], '"foo" = \'baz\''];
        yield ['whereNeq', ['foo', 'baz'], '"foo" != \'baz\''];
        yield ['whereLike', ['foo', 'baz'], '"foo" LIKE \'baz\''];
        yield ['where', ['foo', 'baz', '='], '"foo" = \'baz\''];
    }

    public function testLimitOffset(): void
    {
        $client = $this->createMock(RegisterClientInterface::class);
        $builder = new RegisterRequestBuilder($client);
        $query = $builder->regions()
            ->limit(69)
            ->offset(420)
            ->getQuery();

        self::assertStringContainsString('LIMIT 69 OFFSET 420', $query->asSql());
        self::assertEquals(69, $query->asArray()['limit']);
        self::assertEquals(420, $query->asArray()['offset']);
    }

    public function testOnlyValid(): void
    {
        $client = $this->createMock(RegisterClientInterface::class);
        $builder = new RegisterRequestBuilder($client);
        $query = $builder->regions()
            ->onlyValid()
            ->getQuery();

        self::assertStringContainsString('"validFrom" < ', $query->asSql());
        self::assertStringContainsString('"validTo" >= ', $query->asSql());
    }

    public function testExecute(): void
    {
        $client = $this->createMock(RegisterClientInterface::class);
        $builder = new RegisterRequestBuilder($client);
        $query = $builder->regions()->getQuery();

        $client
            ->expects($this->once())
            ->method('request')
            ->with($query)
            ->willReturn(new Response([], 0));

        $builder->execute();
    }
}
