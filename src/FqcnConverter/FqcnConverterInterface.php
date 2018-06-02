<?php

namespace Ilbox\Utils\FqcnConverter;

interface FqcnConverterInterface
{
    /**
     * @param string $interfaceName
     */
    public function __construct(string $interfaceName);

    /**
     * @param string $className
     */
    public function fqcnToAlias(string $className): string;

    /**
     * @param string $classAlias
     */
    public function aliasToFqcn(string $classAlias): string;

}
