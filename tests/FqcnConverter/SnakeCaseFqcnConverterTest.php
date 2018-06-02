<?php

namespace Ilbox\Utils\Tests\FqcnConverter;

use PHPUnit\Framework\TestCase;
use Ilbox\Utils\FqcnConverter\SnakeCaseFqcnConverter;
use Ilbox\Utils\FqcnConverter\FqcnConverterInterface;

class SnakeCaseFqcnConverterTest extends TestCase
{
    public function testInterface()
    {
        $fqcnConverter = new SnakeCaseFqcnConverter(FqcnConverterInterface::class);
        $this->assertInstanceOf(FqcnConverterInterface::class, $fqcnConverter);
    }

    /**
     * @dataProvider attributeProvider
     */
    public function testFqcnToAlias($interface, $fqcn, $alias)
    {
        $fqcnConverter = new SnakeCaseFqcnConverter($interface);
        $this->assertEquals($fqcnConverter->fqcnToAlias($fqcn), $alias);
    }

    /**
     * @dataProvider attributeProvider
     */
    public function testAliasToFqcn($interface, $fqcn, $alias)
    {
        $fqcnConverter = new SnakeCaseFqcnConverter($interface);
        $this->assertEquals($fqcnConverter->aliasToFqcn($alias), $fqcn);
    }

    public function attributeProvider()
    {
        return [
            ['Foo\\Bar\\FooBarInterface', 'Foo\\Bar\\CustomFooBar', 'CUSTOM'],
            ['Foo\\Bar\\FooBarInterface', 'Foo\\Bar\\SomeCustomFooBar', 'SOME_CUSTOM'],
            ['Foo\\Bar\\FooBarInterface', 'Foo\\Bar\\Custom5FooBar', 'CUSTOM5'],
            ['Foo\\Bar\\FooBarInterface', 'Foo\\Bar\\Some1CustomFooBar', 'SOME1_CUSTOM'],
        ];
    }
}
