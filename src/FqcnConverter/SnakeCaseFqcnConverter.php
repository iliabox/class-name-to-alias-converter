<?php

namespace Ilbox\Utils\FqcnConverter;

use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;

class SnakeCaseFqcnConverter implements FqcnConverterInterface
{
    /**
     * @var SimpleFqcnConverter
     */
    protected $simpleConverter;

    /**
     * @var CamelCaseToSnakeCaseNameConverter
     */
    private $snakeCaseHelper;

    /**
     * @param string $interfaceName
     */
    public function __construct(string $interfaceName)
    {
        $this->simpleConverter = new SimpleFqcnConverter($interfaceName);
        $this->snakeCaseHelper = new CamelCaseToSnakeCaseNameConverter(null, false);
    }

    /**
     * @param string $className
     * @return string
     */
    public function fqcnToAlias(string $className): string
    {
        $ca = $this->simpleConverter->fqcnToAlias($className);

        return strtoupper($this->snakeCaseHelper->normalize($ca));
    }

    /**
     * @param string $classAlias
     * @return string
     */
    public function aliasToFqcn(string $classAlias): string
    {
        $ca = $this->snakeCaseHelper->denormalize(strtolower($classAlias));

        return $this->simpleConverter->aliasToFqcn($ca);
    }

}
