<?php

namespace Ilbox\Utils\Tests\FqcnConverter;

use PHPUnit\Framework\TestCase;
use Ilbox\Utils\FqcnConverter\SimpleFqcnConverter;
use Ilbox\Utils\FqcnConverter\FqcnConverterInterface;

class SimpleFqcnConverterTest extends TestCase
{
    public function testInterface()
    {
        $fqcnConverter = new SimpleFqcnConverter(FqcnConverterInterface::class);
        $this->assertInstanceOf(FqcnConverterInterface::class, $fqcnConverter);
    }

    /**
     * @dataProvider attributeProvider
     */
    public function testFqcnToAlias($interface, $fqcn, $alias)
    {
        $fqcnConverter = new SimpleFqcnConverter($interface);
        $this->assertEquals($fqcnConverter->fqcnToAlias($fqcn), $alias);
    }

    /**
     * @dataProvider attributeProvider
     */
    public function testAliasToFqcn($interface, $fqcn, $alias)
    {
        $fqcnConverter = new SimpleFqcnConverter($interface);
        $this->assertEquals($fqcnConverter->aliasToFqcn($alias), $fqcn);
    }

    public function attributeProvider()
    {
        return [
            ['Foo\\Bar\\FooBarInterface', 'Foo\\Bar\\CustomFooBar', 'Custom'],
            ['Foo\\Bar\\FooBarInterface', 'Foo\\Bar\\SomeCustomFooBar', 'SomeCustom'],
            ['Foo\\Bar\\FooBarInterface', 'Foo\\Bar\\Custom5FooBar', 'Custom5'],
            ['Foo\\Bar\\FooBarInterface', 'Foo\\Bar\\Some1CustomFooBar', 'Some1Custom'],
        ];
    }
}
