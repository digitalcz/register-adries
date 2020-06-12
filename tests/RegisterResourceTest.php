<?php

declare(strict_types=1);

namespace DigitalCz\RegisterAdries;

use Generator;
use PHPUnit\Framework\TestCase;

class RegisterResourceTest extends TestCase
{
    /**
     * @dataProvider provideCreate
     */
    public function testCreate(string $name, string $id): void
    {
        $createMethod = 'create'.ucfirst($name);
        $resource = RegisterResource::$createMethod();
        self::assertEquals($name, $resource->getName());
        self::assertEquals($id, $resource->getId());
    }

    /**
     * @return Generator<array<string>>
     */
    public function provideCreate(): Generator
    {
        yield ['region', '3bbb0b04-8732-4099-b074-c7bd8f8fa080'];
        yield ['county', '1829233e-53f3-4c6a-9ad6-b27f33ec7550'];
        yield ['municipality', '15262453-4a0f-4cce-a9e4-7709e135e4b8'];
        yield ['district', 'cc20ba54-79e5-4232-a129-6af5e75e3d85'];
        yield ['street', 'fc7dc622-a728-4e11-88b1-ee305ceaa896'];
        yield ['unit', 'ea415386-b3cc-44ed-bd9a-7638df4d2e9a'];
        yield ['building', '2ba406d0-5ce5-472d-ba75-5e04f05be1c1'];
        yield ['entrance', 'b89a3dd3-0398-41bc-8c55-5a17617247ea'];
    }
}
